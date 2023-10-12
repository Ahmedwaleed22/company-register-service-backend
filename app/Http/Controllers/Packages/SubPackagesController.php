<?php

namespace App\Http\Controllers\Packages;

use App\Helpers\ApiResponder;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubPackageResource;
use App\Models\Package;
use App\Models\SubPackage;
use Illuminate\Http\Request;

class SubPackagesController extends Controller
{
    use ApiResponder;

    public function get(Package $package) {
        $subPackages = $package->subPackages()->get();
        return $this->apiResponse(SubPackageResource::collection($subPackages));
    }
}
