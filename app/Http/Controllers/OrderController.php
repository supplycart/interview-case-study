<?php

namespace App\Http\Controllers;

use Supplycart\Orders\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @var Orders
     */
    private $order;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Orders $order)
    {
        $this->middleware('auth');
        $this->order = $order;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): object
    {
        $products = json_decode($request->input('products')[0],false);
        $this->order->createOrder($products);
        return redirect()->route('orders');
    }

    /**
     * @return \Illuminate\View\View; 
     */
    public function show(): object
    {
        $orders = $this->order->get();
        return view('orders' , compact('orders'));
    }

}
