<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::where('user_id', Auth::user()->id)->get();

        return view('order', ['data' => $order]);
    }

    public function add()
    {
        $total = 0;
        $cart = session()->get('cart');

        if ($cart !== null) {
            foreach ($cart as $key => $product) {
                $total += $product['price'] * $product['quantity'];
            }

            Order::create([
                'total' => $total,
                'user_id' => Auth::user()->id
            ]);

            session()->forget('cart');
            return redirect()->route('view-order')->withSuccess('Your order has been made');
        }

        return redirect()->back();
    }
}
