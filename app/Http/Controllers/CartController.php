<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())->get();

        return view('carts.index', compact('carts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;

        $product = Product::findOrFail($id);

        $cart = Cart::where('user_id', auth()->id())->where('product_id', $id)->first();
        if(is_null($cart)) {
            $cart = new Cart();
            $cart->user_id = auth()->id();
            $cart->product_id = $id;
            $cart->product_name = $product->product_name;
            $cart->quantity = $quantity;
            $cart->price = $product->price;
            $cart->save();
        } else {
            $cart->quantity = $cart->quantity + $quantity;
            $cart->save();
        }

        ActivityLog::LogRecord('Add to cart ' . $product->product_name);

        return response()->json(['status' => 'success', 'message' => 'Add To Your Cart']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ActivityLog::LogRecord('Remove Item From Cart');
        Cart::destroy($id);
        return response()->json(['status' => 'success', 'message' => 'Delete Your Cart Item']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function allDestroy()
    {
        ActivityLog::LogRecord('Remove All Item From Cart');
        Cart::where('user_id', auth()->id())->delete();
        return response()->json(['status' => 'success', 'message' => 'Delete All Your Cart Item']);
    }
}
