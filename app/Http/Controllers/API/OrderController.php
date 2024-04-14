<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function getOrderList($user_id){
        
        $order = Order::where('user_id', $user_id)->first();

        return response()->json(['data' => $order], 200);
    }

    public function payOrder($order_id){
        dd($order_id);
        //test
    }
}
