<?php

namespace App\Http\Controllers\Packages;

use App\Helpers\ApiResponder;
use App\Http\Controllers\Controller;
use App\Http\Resources\PackageResource;
use App\Models\Package;
use Illuminate\Http\Request;

class MainPackagesController extends Controller
{
    use ApiResponder;

    public function get() {
        $packages = Package::all();
        return $this->apiResponse(PackageResource::collection($packages));
    }
}
