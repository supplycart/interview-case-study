<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class OrderController extends Controller
{
    function index() : Response {
        $orders = auth()->user()->orders()->with('products.category')->whereHas('products', function ($products) {
            $products->orderBy('product_id');
        })->orderBy('id', 'desc')->paginate(10);

        return Inertia::render('Order/Index', [
            'orders' => $orders,
        ]);
    }

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
