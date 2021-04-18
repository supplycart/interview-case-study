<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where([
            ['payment_status', 'unpaid'],
        ])->with([
            'items' => function ($query) {
                $query->with('product');
            }
        ])->first();

        return Inertia::render('Cart', [
            'cart' => $cart
        ]);
    }

    public function addItem(Request $request)
    {
        $validated_data = $request->validate([
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric'
        ]);

        $product = Product::whereHas('rankedProductPrice')->with('rankedProductPrice')->findOrFail($validated_data['product_id']);
        $user = $request->user();

        $cart = Cart::firstOrCreate([
            'user_id' => $user->id,
            'payment_status' => 'unpaid',
        ]);

        $item = CartItem::firstOrNew([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'price' => $product->rankedProductPrice->price,
        ]);

        $item->quantity += $validated_data['quantity'];
        $item->save();

        return response()->json($cart);
    }

    public function deleteItem(Request $request)
    {
        $validated_data = $request->validate([
            'cart_item_id' => 'required|numeric',
        ]);

        $item = CartItem::whereHas('cart')
            ->where('id', $validated_data['cart_item_id'])
            ->first();

        $item->deleted_at = now();
        $item->save();

        return response()->json($item);
    }
}
