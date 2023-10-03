<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    function create() : RedirectResponse {
        $carts = auth()->user()->carts;

        return redirect()->route('home.index')->with('message', 'Order has been sent.');
    }
}
