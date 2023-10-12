<?php

namespace App\Helpers;

use App\Models\Addon;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Package;
use App\Models\Partner;
use App\Models\User;
use App\Models\Service;
use App\Models\SubPackage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

trait CompanyHelper {
  private function createCompany($country, $name, $activities, $addons, $orderID, $totalShares = null, $sharePrice = null, $creatorShareHolds)
    {
        $addonsString = "";

        if ($addons) {
            $addonsString = implode("|", $addons);
        }

        // Create and save company in the database
        return Company::create([
            'country' => $country,
            'name' => $name,
            'activities' => $activities,
            'addons' => $addonsString,
            'order_id' => $orderID,
            'total_shares' => $totalShares,
            'share_price' => $sharePrice,
            'company_creator_share_holds' => $creatorShareHolds
        ]);
    }

    private function createPartners($partnerData)
    {
        // Create and save partner in the database
        return Partner::create($partnerData);
    }

    private function createOrder(User $user, $companyName, $package, $status, $createdBy = 'customer', $addons)
    {
        $totalAddonsPrice = 0;
        $totalAddonsRenewalPrice = 0;

        foreach($addons as $addon) {
            $addon = Addon::where('name', $addon)->firstOrFail();
            $totalAddonsPrice += $addon->price;
            $totalAddonsRenewalPrice += $addon->renewal_price;
        }

        $package = SubPackage::findOrFail($package);

        $order = Order::create([
            'invoiced' => Carbon::now(),
            'status' => $status,
            'package_id' => $package->id,
            'description' => $companyName,
            'user_id' => $user->id,
            'created_by' => $createdBy,
            'total_price' => $package->price + $totalAddonsPrice,
            'base_price' => $package->price + $totalAddonsPrice,
            'renewal_price' => $package->renewal_price + $totalAddonsRenewalPrice,
        ]);

        // Create and save order in the database
        return $order;
    }

    private function createService($company, $user, $orderID, $endDate, $autoRenew = true)
    {
        // Create and save invoice in the database
        return Service::create([
            'description'   => $company->name,
            'company_id'    => $company->id,
            'auto_renewal'  => $autoRenew,
            'order_id'      => $orderID,
            'end_date'      => $endDate,
        ]);
    }

    private function createInvoice($company, $user, $orderID, $serviceID, $status, $price)
    {
        Mail::send('emails.newOrderNotification', [], function ($message) use ($user) {
            $message->to('online@domainostartup.com');
            $message->subject('Domaino Startup New Order Recieved');
        });

        $order = Order::findOrFail($orderID);

        // Create and save invoice in the database
        return Invoice::create([
            'invoice'       => Carbon::now(),
            'description'   => $company->name,
            'company_id'    => $company->id,
            'order_id'      => $orderID,
            'service_id'    => $serviceID,
            'status'        => $status,
            'price'         => $order->total_price,
        ]);
    }
}