<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\UserOrder;
use App\Services\UserOrderService;
use Auth;

class OrdersController extends Controller
{
    public function index()
    {               
        $userId = Auth::user()->id;        
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
                $val['price'] = $product->getCurrentPrice();                
                return $val;
            });
            
            $order->orderDetails = $tmp;
        }       
         
        activity()                               
            ->log('view orders');

        return view('orders.index')->with('orders',$orders);
    }      
    
    public function store(Request $request) {                
        $user_id = Auth::user()->id;              
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
            
            activity()                
                ->performedOn($order)                
                ->log('place order');

            return redirect()->route('products.index');
        } else {
            activity()                                             
                ->log('Error occured. Unable to view order');
            return redirect()->back();  
        }              
    }    
}
