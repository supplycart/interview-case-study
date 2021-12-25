<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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

        $product_name = '';
        $price = 0;
        if($id == 1) {
            $product_name = 'Women\'s Red dress';
            $price = 225.00;
        } else {
            $product_name = 'Hawa Luxe Premium';
            $price = 315.00;
        }

        $cart = Cart::where('user_id', auth()->id())->where('product_id', $id)->first();
        if(is_null($cart)) {
            $cart = new Cart();
            $cart->user_id = auth()->id();
            $cart->product_id = $id;
            $cart->product_name = $product_name;
            $cart->quantity = $quantity;
            $cart->price = $price;
            $cart->save();
        } else {
            $cart->quantity = $cart->quantity + $quantity;
            $cart->save();
        }

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
        Cart::where('user_id', auth()->id())->delete();
        return response()->json(['status' => 'success', 'message' => 'Delete All Your Cart Item']);
    }
}
