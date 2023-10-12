<?php

namespace App\Http\Controllers\Companies;

use App\Helpers\ApiResponder;
use App\Http\Controllers\Controller;
use App\Models\Addon;
use Illuminate\Http\Request;

class AddonsController extends Controller
{
    use ApiResponder;

    public function get() {
        $addons = Addon::all();
        return $this->apiResponse($addons);
    }
}
