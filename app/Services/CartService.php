<?php

namespace App\Services;

class CartService {
    public function getTotalAmount($price, $quantity, $discount = 0): float {
        return ($price - ($price * $discount / 100)) * $quantity;
    }

    public function getTotalDiscount($price, $discounted_price, $quantity): float {
        return ($price - $discounted_price) * $quantity;
    }
}