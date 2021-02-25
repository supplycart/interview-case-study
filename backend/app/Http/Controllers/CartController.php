<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return response()->json(Cart::with(['product'])->get(), 200);
    }

    public function store(Request $request)
    {
        $cart = Cart::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'quantity' => $request->quantity,
            'fulfilled' => $request->fulfilled
        ]);

        return response()->json([
            'status' => (bool) $cart,
            'data'   => $cart,
            'message' => $cart ? 'Cart Created!' : 'Error Creating Cart'
        ]);
    }

    public function show(Cart $cart)
    {
        return response()->json($cart,200);
    }

    public function update(Request $request, Cart $cart)
    {
        $status = $cart->update(
            $request->only(['quantity'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Cart Updated!' : 'Error Updating Cart'
        ]);
    }

    public function destroy(Cart $cart)
    {
        $status = $cart->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Cart Deleted!' : 'Error Deleting Cart'
        ]);
    }
}
