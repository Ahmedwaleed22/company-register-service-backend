<?php

namespace App\Http\Controllers\Orders;

use App\Helpers\ApiResponder;
use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    use ApiResponder;

    public function get(Request $request) {
        $user = $request->user();
        $orders = Invoice::whereHas('order', function($query) use ($user) {
            return $query->where('user_id', '=', $user->id);
        })->with('order', 'company')->get();

        return $this->apiResponse($orders);
    }
}
