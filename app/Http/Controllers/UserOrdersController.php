<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\UserOrder;

class UserOrdersController extends Controller
{
    public function index()
    {
        
    } 
    
    public function addItemToCart($productId) {
        $userId = 1;
        // grab logged in user 
        $userOrder = UserOrder::where([
            ['user_id', '=', 1],
            ['product_id', '=', $productId],
            ['is_fulfilled', '=', false]
        ])->first();

        if (is_null($userOrder)) {
            $userOrder = new UserOrder;
            $userOrder->user_id = $userId;
            $userOrder->product_id = $productId;
            $userOrder->quantity = 1;
            $userOrder->is_fulfilled = false;
        } else {
            $userOrder->quantity++;
        }       
        
        $userOrder->save();        
    }
}
