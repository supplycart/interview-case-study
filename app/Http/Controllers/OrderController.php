<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->user()->id)->paginate();

        return view('order.index', compact('orders'));
    }

    public function view(Order $order)
    {
        return view('order.detail', compact('order'));
    }
}
