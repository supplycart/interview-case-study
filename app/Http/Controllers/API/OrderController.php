<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct(OrderRepository $orderRepository) {
        $this->_orderRepository = $orderRepository;
    }

    public function getOrderList($user_id){
        
        $order = Order::where(['user_id' => $user_id])->orderBy('id', 'DESC')->get();

        return response()->json(['data' => $order], 200);
    }

    public function getOrderDetail($order_id){
        $orderDetail = OrderDetail::with('product')->where(['order_id' => $order_id])->get();

        return response()->json(['data' => $orderDetail], 200);
    }

    public function cancelOrder($order_id){
        try {
            $order = Order::where('id', $order_id)
                ->update(['status' => 0]);

            activity()
                ->log(Auth::user()->id, 'Order '.$order->order_id.' Cancelled');

            return response()->json(['data' => 'done'], 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 500);
        }
    }

    public function checkout(Request $request){
        try{
            $user_id = Auth::guard('api')->user()->id;

            $message = $this->_orderRepository->createOrder($user_id);
            
            if($message){
                return response()->json(['msg' => $message], 400);
            }

            return response()->json(['data' => 'done'], 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 500);
        }
    }
}
