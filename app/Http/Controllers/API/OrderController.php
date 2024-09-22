<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct(OrderRepository $orderRepository) {
        $this->_orderRepository = $orderRepository;
    }

    public function getOrderList($user_id){
        
        $order = Order::where(['user_id' => $user_id, 'status' => 1])->get();

        return response()->json(['data' => $order], 200);
    }

    public function getOrderDetail($order_id){
        $orderDetail = OrderDetail::where(['order_id' => $order_id])->get();

        return response()->json(['data' => $orderDetail], 200);
    }

    public function cancelOrder($order_id){
        Order::update('status', 0)->where('id', $order_id);
    }

    public function checkout(Request $request){
        $user_id = Auth::guard('api')->user()->id;

        $message = $this->_orderRepository->createOrder($user_id);
        
        if($message){
            return response()->json(['msg' => $message], 409);
        }

        return response()->json(['data' => 'done'], 200);
    }
}
