<?php

namespace App\Http\Controllers;

use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Method to get orders for the user
     */
    public function getOrder(){

        $user_id = auth('sanctum')->user()->UserId;

        // get Cart Product and Order where cart status is completed
        $data = Order::where('orders.UserId', $user_id)
            ->join('carts', function ($join) {
                $join->on('orders.CartId', '=', 'carts.CartId')
                    ->where('Status', '=', 'Completed');
            })
            ->join('products', function ($join) {
                $join->on('carts.ProductId', '=', 'products.ProductId');
            })
            ->orderBy('OrderId','desc')
            ->get();

        Log::channel('syslog')->info('User '. $user_id . ' retrieved order history.');

        return OrderResource::collection($data);
    }

}
