<?php

namespace App\Actions\Carts;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class DeleteItemFromCartAction
{
    /**
     * @throws \Throwable
     */
    public function execute(int $productId): void
    {
        throw_if(Product::whereId($productId)->doesntExist(), new \Exception('Product not found'));

        Auth::user()
            ->carts()
            ->where('product_id', $productId)
            ->delete();
    }
}
