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

    public function addToCart(Request $request)
    {
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
        $cart = $this->getCurrentCart();

        // calculate grand total
        $grandTotal = $cart->items->sum(function ($item) {
            return $item->productVariation->price * $item->quantity;
        });

        // calculate discount
        $discount = 0; // no discount implementation yet

        // calculate discounted price
        $discountedPrice = $grandTotal - $discount;

        $tax = $discountedPrice * 0.06;

        $netPrice = $discountedPrice + $tax;

        return Inertia::render('Cart/Show', [
            'cart' => $cart,
            'checkout_summary' => [
                'grand_total' => $grandTotal,
                'discount' => $discount,
                'tax' => $tax,
                'net_price' => $netPrice,
            ],
        ]);
    }

    private function getCurrentCart()
    {
        $user = auth()->user();
        $cart = $user->carts()->where('status', CartStatus::PENDING_CHECKOUT->value)->first();

        if (!$cart) {
            $cart = $this->createCart();
        }

        return $cart->loadMissing('items.productVariation.product');
    }

    private function createCart()
    {
        $user = auth()->user();
        return $user->carts()->create();
    }
}
