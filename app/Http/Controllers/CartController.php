<?php

namespace App\Http\Controllers;

use App\CartStatus;
use App\Models\Cart;
use App\Models\ProductVariation;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{

    public function addToCart(Request $request) {
        $validatedData = $request->validate([
            'product_variation_id' => 'required|integer|exists:product_variations,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->getCurrentCart();
        $item = $cart->items()->where('product_variation_id', $validatedData['product_variation_id'])->first();

        if (!$item) {
            $cart->items()->create($validatedData);
        } else {
            $item->quantity = $item->quantity + $validatedData['quantity'];
            $item->save();
        }

        return redirect()->back();
    }

    public function show()
    {
        return Inertia::render('Cart/Show', [
            'cart' => $this->getCurrentCart(),
        ]);
    }

    private function getCurrentCart()
    {
        $user = auth()->user();
        $cart = $user->carts()->where('status', CartStatus::PENDING_CHECKOUT->value)->first();

        if (!$cart) {
            $cart = $this->createCart();
        }

        return $cart;
    }

    private function createCart()
    {
        $user = auth()->user();
        return $user->carts()->create();
    }
}
