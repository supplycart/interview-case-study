<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserOrderService;
use App\UserOrder;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = 1;
      
        $pendingOrders = UserOrderService::getPendingOrderDetails($userId);      
        $pendingOrdersCount = count($pendingOrders);
        $totalPrice = UserOrderService::getTotalPrice($pendingOrders);        
        
        $data = [ 
            'pendingOrders' => $pendingOrders,
            'pendingOrdersCount' => $pendingOrdersCount,
            'totalPrice' => $totalPrice
        ];
      
        return view('cart.index', $data);
    }
}
