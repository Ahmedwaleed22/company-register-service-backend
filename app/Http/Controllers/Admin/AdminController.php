<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CompanyHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Mail\SupportCreatedOrderEmail;
use App\Models\SubPackage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    use CompanyHelper;

    public function index() {
        return view('index');
    }


    public function store(Request $request)
    {
        $request->merge([
            'user.password' => Hash::make('[s8TK<<T37\U')
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

        $checkIfUserExist = User::where('email', $userData['email'])->first();

        if ($checkIfUserExist) {
            $user = $checkIfUserExist;
        } else {
            // Create User
            $user = $this->createUser($userData);
        }

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
        $order = $this->createOrder($user, $companyData['name'], $package->id, 'Pending', 'support', $addons);

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

        $this->createService($company, $user, $order->id, Carbon::now()->addDays(355));

        Mail::to($user->email)->send(new SupportCreatedOrderEmail($user, $order->id));

        return response(['user' => $user, 'order' => new OrderResource($order), 'message' => 'Registeration successful']);
    }

    private function createUser($userData)
    {
        // Create and save user in the database
        return User::create($userData);
    }
}
