<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        return Inertia::render('OrderHistory');
    }

    public function checkout()
    {
        $cart = session('cart', []);
        if (!$cart) {
            return redirect()->route('product.index');
        }

        return Inertia::render('Checkout');
    }
}
