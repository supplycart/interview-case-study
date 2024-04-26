<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use App\Models\Order;

class OrderController extends Controller
{
    public function __construct(OrderRepository $orderRepository) {
        $this->_orderRepository = $orderRepository;
    }

    public function getOrderList($user_id){
        
        $order = Order::where('user_id', $user_id)->first();

        return response()->json(['data' => $order], 200);
    }

    public function checkout(Request $request){
        
        $cart = Cart::where('user_id', $request->user_id)->get();

        $this->_orderRepository->createOrder($request->user_id, $cart);

        return response()->json(['data' => 'done'], 200);
    }
}
