<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function getOrderList(){
        $order_list = Order::all();

        return response()->json(['data' => $order_list], 200);
    }

    // public function createOrder(){

    // }
}
