<?php

namespace App\Services;

use App\UserOrder;
use App\Product;

class UserOrderService
{
    public static function getUserOrdersWithOrdersByUserId($userId) {
      
      
      return $userOrders = UserOrder::where([
        ['user_id', '=', $userId], 
        ['product_id', '>', 0],                  
      ])->get();      
    }

    public static function getTotalPrice($userOrders)
    {
        $totalPrice = 0;
      
        foreach($userOrders as $userOrder) {
          $product = Product::find($userOrder->product_id);
          $price = $product->cost * $userOrder->quantity;
          $totalPrice += $price;
        }

        return number_format($totalPrice, 2);
    }    
    
    public static function getPendingOrderDetails($userId) {
        $pendingOrders = UserOrder::where([
            ['user_id', '=', $userId],            
            ['is_fulfilled', '=', false]
        ])->get();

        foreach($pendingOrders as $pendingOrder) {
          $product = Product::find($pendingOrder->product_id);
          $pendingOrder->productPrice = $product->cost;
          $pendingOrder->productName = $product->name;
        }

        return $pendingOrders;
    }
}
