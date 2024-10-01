<?php

namespace App\Actions;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddToCartAction
{
    /**
     * @throws \Exception
     */
    public function execute(int $productId, int $quantity = 1): void
    {
        $product = Product::findOrFail($productId);

        if ($product->stock < $quantity) {
            throw new \Exception('Insufficient stock');
        }

        Auth::user()
            ->carts()
            ->upsert(
                ['product_id' => $productId, 'quantity' => $quantity],
                ['product_id', 'user_id'],
                ['quantity' => DB::raw('quantity + ' . $quantity)]
            );
    }
}
