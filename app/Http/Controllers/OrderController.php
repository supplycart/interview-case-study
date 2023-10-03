<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    function create() : RedirectResponse {
        $products = auth()->user()->carts;
        $total_price = $products->sum('price');

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'total_amount' => $total_price,
            'payed_amount' => 0,
        ]);

        $order->products()->saveMany($products);

        auth()->user()->user_carts()->delete();

        return redirect()->route('home.index')->with('message', 'Order has been sent.');
    }
}
