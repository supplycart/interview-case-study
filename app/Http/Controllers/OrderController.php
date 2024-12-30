<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return Inertia::render('Order/Index', [
            'orders' => $user->orders()->select('id', 'order_identifier', 'net_price', 'order_status', 'created_at')->latest()->paginate(10)
        ]);
    }
}
