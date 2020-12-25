<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\UserOrder;
use Auth;

class UserOrdersController extends Controller
{
    public function index()
    {
        
    } 
    
    public function store(Request $request) {        
        $userId = Auth::user()->id;        
        // grab logged in user 
        $userOrder = UserOrder::where([
            ['user_id', '=', 1],
            ['product_id', '=', $request->productId],
            ['is_fulfilled', '=', false]
        ])->first();

        if (is_null($userOrder)) {
            $userOrder = new UserOrder;
            $userOrder->user_id = $userId;
            $userOrder->product_id = $request->productId;
            $userOrder->quantity = 1;
            $userOrder->is_fulfilled = false;
        } else {
            $userOrder->quantity++;
        }       
        
        $userOrder->save(); 
        activity()                
            ->performedOn($userOrder)                
            ->log('place item in cart');

        return redirect()->back();  
    }
}
