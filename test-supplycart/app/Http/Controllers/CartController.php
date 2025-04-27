<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Session;
use Log;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getCartItems = Session::get('cart');
        if($getCartItems !== null){
         return Inertia::render('Cart')->with(["data" => json_decode($getCartItems)]);
        } else {
            return Inertia::render('Cart');
        }
    }

    public function store(Request $request)
    {
        if(Session::get('cart') !== null){
            // Cart exists
            $cart = json_decode(Session::get('cart'), true);
            if(isset($cart[$request->id])){
                // Add qty if item exists
                $cart[$request->id]['qty'] += 1;

            } else {
                // Add new item if item doesn't exist
                $cart[$request->id]['name'] = $request->name;
                $cart[$request->id]['qty'] = 1;
                $cart[$request->id]['price'] = $request->price;
            }
            Session::put('cart', json_encode($cart));
        } else{
            // Cart doesn't exist
            $cart[$request->id]['qty'] = 1;
            $cart[$request->id]['name'] = $request->name;
            $cart[$request->id]['price'] = $request->price;
            Session::put('cart', json_encode($cart));
        }
        return ["message" => "Added to cart"];

    }
}
