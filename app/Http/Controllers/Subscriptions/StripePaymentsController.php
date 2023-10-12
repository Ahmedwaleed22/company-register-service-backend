<?php

namespace App\Http\Controllers\Subscriptions;

use App\Helpers\ApiResponder;
use App\Helpers\CompanyHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\CardResource;
use App\Mail\InvoiceEmail;
use App\Mail\OrderCancellationDueToPaymentIssueMail;
use App\Mail\OrderCancellationMail;
use App\Mail\OrderPaymentPendingMail;
use App\Mail\UpcomingInvoiceEmail;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\SubPackage;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StripePaymentsController extends Controller
{
    use ApiResponder, CompanyHelper;

    public $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
    }

    public function listCards(Request $request)
    {
        $user = $request->user();
        $customerID = $user->stripe_customer_id;

        $paymentMethods = $this->stripe->paymentMethods->all([
            'customer' => $customerID,
            'type' => 'card',
        ]);

        return $this->apiResponse(CardResource::collection($paymentMethods->data));
    }

    public function addCard(Request $request)
    {
        $request->validate([
            'token' => 'required|string'
        ]);

        $user = $request->user();
        $customerID = $user->stripe_customer_id;

        if (!$customerID) {
            $customer = $this->stripe->customers->create([
                'name' => "$user->first_name $user->last_name",
                'email' => $user->email,
            ]);

            $customerID = $customer->id;

            $user->stripe_customer_id = $customerID;
            $user->save();
        }

        $source = $this->stripe->customers->createSource(
            $customerID,
            ['source' => env("APP_ENV") === 'local' ? 'tok_amex' : $request->token]
        );

        return $this->apiResponse(new CardResource($source), 201);
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'card' => 'required|string',
        ]);

        $order = Order::findOrFail($request->order_id);

        $user = $request->user();
        $company = $order->company;
        $service = $order->service;
        $newRenewalDate = strtotime('+355 days');

        $customerID = $user->stripe_customer_id;

        $package = SubPackage::findOrFail($order->package_id);

        $price = $this->stripe->prices->create([
            'unit_amount' => $order->total_price * 100,
            'currency' => 'usd',
            'product_data' => [
                'name' => $company->name
            ],
            'recurring' => ['interval' => 'year'],
        ]);

        $renewalPrice = $this->stripe->prices->create([
            'unit_amount' => $order->renewal_price * 100,
            'currency' => 'usd',
            'product_data' => [
                'name' => $company->name . ' Renewal'
            ],
            'recurring' => ['interval' => 'year'],
        ]);

        try {
            $invoice = $order->invoices->last();

            $subscription = $this->stripe->subscriptionSchedules->create([
                'customer' => $customerID,
                'start_date' => 'now',
                'end_behavior' => 'release',
                'metadata' => [
                    'order_id' => $order->id,
                    'invoice_id' => $invoice->id,
                ],
                'phases' => [
                    [
                        'items' => [
                            [
                                'price' => $price->id,
                                'quantity' => 1,
                            ],
                        ],
                        'end_date' => $newRenewalDate,
                        'metadata' => [
                            'order_id' => $order->id,
                            'invoice_id' => $invoice->id,
                        ],
                    ],
                    [
                        'items' => [
                            [
                                'price' => $renewalPrice->id,
                                'quantity' => 1,
                            ],
                        ],
                        'billing_cycle_anchor' => 'phase_start',
                        'proration_behavior' => 'none',
                        'metadata' => [
                            'order_id' => $order->id,
                            'invoice_id' => $invoice->id,
                        ],
                        'iterations' => '10'
                    ]
                ],
            ]);


            $service->stripe_subscription_id = $subscription->id;
            $service->save();

            return $this->apiResponse([
                'message' => 'Transaction successful'
            ], 201);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $order->status = 'refused';
            $order->save();

            return $this->apiResponse([
                'message' => 'Transaction refused',
            ], 400);
        } catch (Exception $e) {
            $order->status = 'refused';
            $order->save();

            return $this->apiResponse([
                'message' => 'Transaction refused',
            ], 400);
        }
    }

    public function webhook(Request $request)
    {
        if (isset($request->type) && $request->type === 'invoice.paid') {
            $metadata = $request->data['object']['subscription_details']['metadata'];
            $orderID = $metadata['order_id'];
            $invoiceID = $metadata['invoice_id'];

            $order = Order::findOrFail($orderID);
            $order->status = 'Invoiced';
            $order->save();

            $invoice = Invoice::findOrFail($invoiceID);
            $invoice->status = 'Paid';
            $invoice->save();

            $user = User::findOrFail($order->user_id);
            Mail::to($user->email)->send(new InvoiceEmail($order, $order->company, $user));
        }

        if (isset($request->type) && $request->type === 'invoice.upcoming') {
            $metadata = $request->data['object']['subscription_details']['metadata'];
            $orderID = $metadata['order_id'];
            $invoiceID = $metadata['invoice_id'];

            $order = Order::findOrFail($orderID);

            $user = User::findOrFail($order->user_id);
            Mail::to($user->email)->send(new UpcomingInvoiceEmail($order, $order->company, $user, $order->service, $order->package));
        }

        if (isset($request->type) && $request->type === 'subscription_schedule.canceled') {
            $metadata = $request->data['object']['subscription_details']['metadata'];
            $orderID = $metadata['order_id'];
            $invoiceID = $metadata['invoice_id'];

            $order = Order::findOrFail($orderID);

            $order->status = 'canceled';
            $order->save();

            $user = User::findOrFail($order->user_id);
            Mail::to($user->email)->send(new OrderCancellationMail($order, $order->company, $user, $order->service, $order->package));
        }

        if (isset($request->type) && $request->type === 'invoice.payment_failed') {
            $metadata = $request->data['object']['subscription_details']['metadata'];
            $orderID = $metadata['order_id'];
            $invoiceID = $metadata['invoice_id'];

            $order = Order::findOrFail($orderID);

            $order->status = 'canceled';
            $order->save();

            $user = User::findOrFail($order->user_id);
            Mail::to($user->email)->send(new OrderCancellationDueToPaymentIssueMail($order, $order->company, $user, $order->service, $order->package));
        }

        if (isset($request->type) && $request->type === 'invoice.created') {
            $metadata = $request->data['object']['subscription_details']['metadata'];
            $orderID = $metadata['order_id'];
            $invoiceID = $metadata['invoice_id'];

            $order = Order::findOrFail($orderID);

            $user = User::findOrFail($order->user_id);
            Mail::to($user->email)->send(new OrderPaymentPendingMail($order, $order->company, $user, $order->service, $order->package));
        }
    }
}
