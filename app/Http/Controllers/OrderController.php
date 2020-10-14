<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index() {
        $orders = Auth::user()->orders;
        foreach ($orders as $order) {
            $order['items'] = $order->items;
        }
        return response()->json([$orders], 200);
    }
}
