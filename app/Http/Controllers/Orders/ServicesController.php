<?php

namespace App\Http\Controllers\Orders;

use App\Helpers\ApiResponder;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Service;
use App\Models\SubPackage;
use Exception;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    use ApiResponder;

    public $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
    }

    public function get(Request $request)
    {
        $user = $request->user();
        $orders = $user->orders()->whereHas('service')->with('service', 'company', 'user')->get();
        return $this->apiResponse(ServiceResource::collection($orders));
    }

    public function update(Request $request, Service $service)
    {
        $subscriptionId = $service->stripe_subscription_id;

        if (!$subscriptionId) {
            $service->auto_renewal = true;
            $service->save();
            return $this->apiResponse(['message' => 'Subscription status updated']);
        }

        try {
            $subscriptionSchedule = $this->stripe->subscriptionSchedules->retrieve($subscriptionId);

            if ($subscriptionSchedule->status === 'active') {
                // If the subscription schedule is active, cancel it.
                $this->stripe->subscriptionSchedules->cancel($subscriptionId);
                $service->auto_renewal = false;
                $service->save();
                return $this->apiResponse(['message' => 'Subscription renewal canceled successfully'], 200);
            } elseif ($subscriptionSchedule->status === 'canceled') {
                // If the subscription schedule is canceled, renew it.
                $order = Order::findOrFail($service->order->id);
                $user = $request->user();
                $company = $order->company;
                $newRenewalDate = strtotime('+355 days');

                $package = SubPackage::findOrFail($order->package_id);
                $invoice = Invoice::findOrFail($subscriptionSchedule->metadata['invoice_id']);

                $price = $this->stripe->prices->create([
                    'unit_amount' => $package->price * 100,
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $company->name
                    ],
                    'recurring' => ['interval' => 'year'],
                ]);
        
                $renewalPrice = $this->stripe->prices->create([
                    'unit_amount' => ($package->renewal_price - $package->price) * 100,
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $company->name . ' Renewal'
                    ],
                    'recurring' => ['interval' => 'year'],
                ]);

                // Recreate the subscription schedule using previously set parameters.
                $subscription = $this->stripe->subscriptionSchedules->create([
                    'customer' => $user->stripe_customer_id,
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
                $service->auto_renewal = true;
                $service->save();


                return $this->apiResponse(['message' => 'Subscription restarted successfully'], 201);
            } else {
                return $this->apiResponse(['message' => 'Invalid subscription state'], 400);
            }
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return $this->apiResponse(['message' => 'Error toggling subscription state'], 400);
        } catch (Exception $e) {
            return $this->apiResponse(['message' => 'Unknown error occurred'], 500);
        }
    }
}
