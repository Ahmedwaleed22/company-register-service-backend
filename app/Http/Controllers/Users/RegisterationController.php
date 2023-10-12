<?php

namespace App\Http\Controllers\Users;

use App\Helpers\CompanyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterationRequest;
use App\Http\Resources\OrderResource;
use App\Models\User;
use App\Models\SubPackage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegisterationController extends Controller
{
    use CompanyHelper;

    public function register(RegisterationRequest $request)
    {
        $request->merge([
            'user.password' => $request->input('user')['password']
        ]);

        $companyData = $request->input('company');
        $userData = $request->input('user');
        $partnersData = $request->input('partners');

        $totalShares = null;
        $sharePrice = null;

        if (isset($companyData['total_shares'])) {
            $totalShares = $companyData['total_shares'];
        }

        if (isset($companyData['share_price'])) {
            $sharePrice = $companyData['share_price'];
        }

        $userPassportPath = $request->file('user.passport')->store('passports');

        $userData['passport'] = $userPassportPath;

        // Create User
        $user = $this->createUser($userData);

        $packageID = 0;

        switch ($companyData['country']) {
            case "uk":
                $packageID = 1;
                break;
            case "us":
                $packageID = 2;
                break;
            case "us":
                $packageID = 3;
                break;
            default:
                $packageID = 1;
                break;
        }

        $package = SubPackage::where('slug', $companyData['package'])
            ->where('package_id', $packageID)->firstOrFail();

        if (isset($companyData['addons'])) {
            $addons = $companyData['addons'];
        } else {
            $addons = [];
        }

        // Create Order
        $order = $this->createOrder($user, $companyData['name'], $package->id, 'Pending', 'customer', $addons);

        // Create Company
        $company = $this->createCompany($companyData['country'], $companyData['name'], $companyData['activities'], $addons, $order->id, $totalShares, $sharePrice, $userData['share_holds']);

        // Create Partners (up to 6 partners)
        $partners = [];
        $partnerCount = 0;
        if ($partnersData) {
            foreach ($partnersData as $index => $partnerData) {
                if ($partnerCount >= 6) {
                    break; // Limit reached, stop creating partners
                }
    
                $partnerPassportPath = $request->file("partners.{$index}.passport")->store('passports');
                $partnerData = array_merge($partnerData, [
                    'company_id' => $company->id,
                    'passport' => $partnerPassportPath,
                    'order_id' => $order->id,
                ]);
    
                $partners[] = $this->createPartners($partnerData);
                $partnerCount++;
            }
        }

        $service = $this->createService($company, $user, $order->id, Carbon::now()->addDays(355));

        $this->createInvoice($company, $user, $order->id, $service->id, 'Pending Payment', $package->price);

        $token = $user->createToken('authToken')->plainTextToken;

        return response(['user' => $user, 'token' => $token, 'order' => new OrderResource($order), 'message' => 'Registeration successful']);
    }

    private function createUser($userData)
    {
        // Create and save user in the database
        return User::create($userData);
    }
}
