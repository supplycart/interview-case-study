<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $cart = Auth::user()->cart;
        if (is_null($cart)) {
            $cart = Cart::create(['user_id' => Auth::user()->id]);
        }
        $cart_with_items = Cart::with(['items'])->where('id', $cart->id)->first();

        return response->json(['name' => $cart_with_items]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $user = Auth::user()->cart;
        $cart = $user->cart();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
