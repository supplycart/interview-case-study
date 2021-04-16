<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function place(Request $request)
    {
        $validated_data = $request->validate([
            'cart_id' => 'required|numeric'
        ]);

        $user = $request->user();

        $cart = Cart::where([
            ['user_id', $user->id]
        ])->findOrFail($validated_data['cart_id']);

        $cart->payment_status = 'paid';
        $cart->save();

        $order = Order::create([
            'cart_id' => $cart->id
        ]);

        return response()->json($order);
    }

    public function show(Order $order)
    {
        return Inertia::render('Order', [
            'order' => $order
        ]);
    }
}
