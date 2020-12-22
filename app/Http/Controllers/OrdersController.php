<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\UserOrder;

class OrdersController extends Controller
{
    public function index()
    {
        
    }   
    
    public function viewOrderHistory() {
        $user_id = 1; 
        
        $orders = Order::where([
            ['user_id', '=', $user_id],            
        ])->get();;
        
        return $orders;
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
                $user_order->fulfilled = true;
                $user_order->save();
            }            
            return ('Order placed');
        } else {
            return('No user orders found');
        }              
    }    
}
