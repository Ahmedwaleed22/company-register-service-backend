<?php

namespace App\Http\Controllers\Subscriptions;

use App\Helpers\ApiResponder;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodesController extends Controller
{
    use ApiResponder;

    public function show(PromoCode $code)
    {
        return $this->apiResponse($code);
    }

    public function apply(PromoCode $code, Order $order)
    {
        if ($code->type === 'amount') {
            $price = $order->base_price - $code->amount;

            $order->total_price = $price;
            $order->save();
        } else {
            $price = $order->base_price - ($order->base_price * ($code->amount / 100));

            $order->total_price = $price;
            $order->save();
        }

        return $this->apiResponse([
            'order' => new OrderResource($order),
            'code' => $code,
        ]);
    }
}
