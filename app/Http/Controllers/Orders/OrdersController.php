<?php

namespace App\Http\Controllers\Orders;

use App\Helpers\ApiResponder;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    use ApiResponder;

    public function get(Request $request) {
        $user = $request->user();
        $orders = $user->orders;
        return $this->apiResponse(OrderResource::collection($orders));
    }

    public function show($orderID) {
        $order = Order::with('user', 'company', 'company.partners', 'package')->findOrFail($orderID);

        if ($order->created_by === 'support') {
            $user = User::findOrFail($order->user->id);
            return $this->apiResponse([
                'order' => $order,
                'token' => $user->createToken('authToken')->plainTextToken
            ]);
        } else {
            return $this->apiResponse([
                'order' => $order,
            ]);
        }

        return $this->apiResponse(401);
    }
}
