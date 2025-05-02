<?php

namespace App\Repositories\Eloquent;

use App\Models\Cart;
use App\Repositories\Contracts\CartRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CartRepository implements CartRepositoryInterface
{
    public function getUserCart(int $userId): array
    {
        return Cart::with('product:id,name,price,image_path')
            ->where('user_id', $userId)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->qty,
                    'product' => [
                        'name' => $item->product->name,
                        'price' => $item->product->price,
                        'image_url' => $item->product->image_path
                            ? asset($item->product->image_path)
                            : asset('images/default-product.jpg'),
                    ],
                ];
            })
            ->values()
            ->toArray();
    }

    public function addOrUpdate(int $userId, int $productId, int $qty): void
    {
        $cart = Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cart) {
            $cart->qty += $qty;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'qty' => $qty,
            ]);
        }
    }

    public function bulkSync(int $userId, array $items): void
    {
        foreach ($items as $item) {
            Cart::updateOrCreate(
                [
                    'user_id' => $userId,
                    'product_id' => $item['product_id'],
                ],
                [
                    'qty' => $item['quantity'],
                ]
            );
        }
    }

    public function deleteFromCart(int $userId, int $productId): void
    {
        Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->delete();
    }
}
