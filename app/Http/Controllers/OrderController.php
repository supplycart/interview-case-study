<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders;

        return inertia('Order/Listing', [
            'orders' => $orders
        ]);
    }

    public function show(Order $order)
    {
        // Check if the order belongs to the user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return inertia('Order/Show', [
            'order' => $order,
            'items' => $order->items()->with('product')->get(),
        ]);
    }
}
