<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        return Inertia::render('Cart', ['cartItems' => $cartItems]);
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $existingCartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($existingCartItem) {
            // If the item is already in the cart, add the quantity
            $existingCartItem->quantity += $validated['quantity'];
            $existingCartItem->save();
        } else {
            // If the item is not in the cart, create a new entry
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity']
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    public function remove($id)
    {
        Cart::where('user_id', auth()->id())->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Product removed from cart successfully.');
    }

    public function clearCart()
    {
        Cart::where('user_id', auth()->id())->delete();
        return redirect()->back()->with('success', 'Cart cleared successfully.');
    }
}
