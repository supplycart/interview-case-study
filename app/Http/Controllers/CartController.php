<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;

class CartController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function index() 
    {
        // $carts = Cart::where('user_id', Auth::user()->id)->get();
        $carts = Cart::where('user_id',1)->get();

        if (!$carts) {
            return response()->json([
                'error' => 404,
                'message' => 'Not Found'
            ], 404);
        }

        return response()->json([
            "carts"    => $carts,
        ], 200);
    }

    public function store(Request $request)
    {
        $cart = Cart::where('user_id', 1)->where('product_id', $request->id)->first();

        if (!$cart) 
        {
            $cart = new Cart();
            // $cart->user_id = Auth::user()->id;
            $cart->user_id = 1;
            $cart->product_id = $request->id;
            $cart->quantity = $request->quantity;
        } 
        else
        {
            $cart->quantity = $cart->quantity + $request->quantity;
        }
        
        $cart->save();

        return response()->json([
            'cart' => $cart,
            'message' => 'Update Cart Successfully!'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        // $cart = Cart::updateOrCreate(['user_id' => Auth::user()->id, 'product_id' => $request->id], ['quantity' => $request->quantity]);
        $cart = Cart::updateOrCreate(['user_id' => 1, 'product_id' => $id], ['quantity' => $request->quantity]);

        return response()->json([
            'cart' => $cart,
            'message' => 'Update Cart Successfully!'
        ], 200);
    }

    public function deleteCart()
    {
        // $deletedCart = Cart::where('user_id', Auth::user()->id)->delete();
        Cart::where('user_id', 1)->delete();
        return response()->json(['message' => 'Delete Successfully!', 200]);
    }

    public function delete($id)
    {
        // $cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $id)->get();

        $cart = Cart::where('user_id', 1)->where('product_id', $id);

        if (!$cart) {
            return response()->json([
                'error' => 404,
                'message' => 'Not Found'
            ], 404);
        }

        $cart->delete();
        return response()->json(['message' => 'Remove Successfully!', 200]);
    }
}
