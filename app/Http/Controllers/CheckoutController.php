<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function index()
    {
        return Inertia::render('Checkout');
    }
}
