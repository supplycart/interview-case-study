<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    // Fetch all orders for the authenticated user
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->get();

        return response()->json([
            'message' => 'Order history retrieved successfully',
            'orders' => $orders
        ]);
    }

    // Fetch a specific order by ID for the authenticated user
    public function show($id)
    {
        $order = Order::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        return response()->json([
            'message' => 'Order retrieved successfully',
            'order' => $order
        ]);
    }
}
