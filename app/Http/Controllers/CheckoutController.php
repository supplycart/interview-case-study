<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\OrderContract;

class CheckoutController extends Controller
{
    public function getCheckout($total)
    {
        return view('checkout', compact('total'));
    }
}
