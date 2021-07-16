<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;
use App\Models\Product;

class OrderController extends Controller
{
    //

    public function index()
    {
        $id = Auth::id();
        $orders = Order::where('user_id', $id)->get();
        // echo $orders;
        return view('shop.orders', compact('orders'));
    }

}
