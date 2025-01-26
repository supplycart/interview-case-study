<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Exception;

class OrderController extends Controller
{
    protected $cartService;
    protected $orderService;

    public function __construct(CartService $cartService,OrderService $orderService)
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
    }

   
    /**
     * display orders listing page
     *
     */
    public function Orders(){

        $orders = $this->orderService->getOrders();
       
        return Inertia::render('Order/List',[
            'orders' => $orders,
        ]);
      
    }

     /**
     * display order summary page
     *
     */
    public function orderSummary($id){

        $order = $this->orderService->getOrderById($id);
        //dd($order->toArray());
        return Inertia::render('Order/Summary',[
            'order' => $order->toArray(),
        ]);
      
    }
}
