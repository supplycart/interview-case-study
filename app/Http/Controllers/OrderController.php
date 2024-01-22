<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function list(){
        $order_list = Order::all();

        return view('order.list', compact('order_list'));
    }
}
