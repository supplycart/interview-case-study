<?php

namespace App\Actions\Carts;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddToCartAction
{
    /**
     * @throws \Throwable
     */
    public function execute(int $productId, int $quantity = 1): void
    {
        $product = Product::findOrFail($productId);

        throw_if($product->stock < $quantity, new \Exception('Insufficient stock'));

        Auth::user()
            ->carts()
            ->upsert(
                ['product_id' => $productId, 'quantity' => $quantity],
                ['product_id', 'user_id'],
                ['quantity' => DB::raw('quantity + '.$quantity)]
            );

        Auth::user()
            ->carts()
            ->where('quantity', '<=', 0)
            ->delete();
    }
}
