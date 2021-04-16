<?php

namespace App\Observers;

use App\Models\Cart;
use App\Models\CartItem;

class CartItemObserver
{
    public function created(CartItem $item)
    {
        $this->calculate($item);
    }

    public function updated(CartItem $item)
    {
        $this->calculate($item);
    }

    public function deleted(CartItem $item)
    {
        $this->calculate($item);
    }

    public function forceDeleted(CartItem $item)
    {
        $this->calculate($item);
    }

    protected function calculate(CartItem $item)
    {
        $cart = Cart::find($item->cart_id);
        $cart->total = $cart->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        $cart->save();
    }
}
