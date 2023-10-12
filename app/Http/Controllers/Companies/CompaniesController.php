<?php

namespace App\Http\Controllers\Companies;

use App\Helpers\ApiResponder;
use App\Helpers\CompanyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\OrderResource;
use App\Models\Company;
use App\Models\Order;
use App\Models\SubPackage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CompaniesController extends Controller
{
    use CompanyHelper, ApiResponder;

    public function get(Request $request)
    {
        $user = $request->user();
        $company = Order::where('user_id', $user->id)->with('company')->get();
        return $this->apiResponse(CompanyResource::collection($company));
    }

    public function store(CompanyRequest $request)
    {
        $userData = $request->input('user');
        $companyData = $request->input('company');
        $partnersData = $request->input('partners');

        $totalShares = null;
        $sharePrice = null;

        if (isset($companyData['total_shares'])) {
            $totalShares = $companyData['total_shares'];
        }

        if (isset($companyData['share_price'])) {
            $sharePrice = $companyData['share_price'];
        }
    
        $user = $request->user();

        $package = SubPackage::where('slug', $companyData['package'])->firstOrFail();

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

        
        return $this->apiResponse([
            'company' => $company,
            'order' => new OrderResource($order),
            'package' => $package,
            'partners' => $partners,
        ]);
    }

    public function checkIfCompanyNamedUsed($companyName)
    {
        $apiUrl = "https://api.companieshouse.gov.uk/search/companies";
        $apiKey = "ab894d41-8613-487d-a5af-682f50c9ccaa"; // Replace with your actual API key

        $client = new Client([
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($apiKey . ':'),
            ],
        ]);

        $response = $client->get($apiUrl, [
            'query' => [
                'q' => $companyName,
                'restrictions' => 'active-companies legally-equivalent-company-name'
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        $companiesFound = $data['items'] ?? [];

        return $this->apiResponse([
            'is_taken' => !empty($companiesFound),
        ]);
    }
}
