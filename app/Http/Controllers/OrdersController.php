<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\UserOrder;
use App\Services\UserOrderService;

class OrdersController extends Controller
{
    public function index()
    {               
        $userId = 1; 
        $userOrders = UserOrderService::getUserOrdersWithOrdersByUserId($userId);        
        $orders = Order::where([
            ['user_id', '=', $userId],                             
          ])->get();   

        foreach($orders as $order) {
            $tmp = $userOrders->filter(function ($val, $key) use ($order) {
                return $val['order_id'] == $order->id;
            });   

            $tmp->map(function ($val, $key) {
                $product = Product::find($val->product_id);
                $val['productName'] = $product->name;
                return $val;
            });
            
            $order->orderDetails = $tmp;
        }       
                             
        return view('orders.index')->with('orders',$orders);
    }      
    
    public function store(Request $request) {                
        $user_id = 1;              
        $user_order_ids = $request['selected'];
        
        if (count($user_order_ids) > 0) {           
            $order = Order::create([
                'is_fulfilled' => true,
                'user_id' => $user_id,                
            ]);            

            foreach($user_order_ids as $user_order_id) {
                $user_order = UserOrder::find($user_order_id);
                $user_order->order_id = $order->id;
                $user_order->is_fulfilled = true;
                $user_order->save();
            }            
            return redirect()->route('products.index');
        } else {
            return redirect()->back();  
        }              
    }    
}
