<?php

namespace App\Http\Controllers;

use App\CartStatus;
use App\Models\Cart;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{

    public function addToCart() {}

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
