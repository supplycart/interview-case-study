<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Support\Cart;
use App\Models\Good;

class CartResource extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        [$goods, $cartItems] = $this->resource;

        return [
            'count' => Cart::getCount(),
            'total' => $goods->reduce(fn (?float $carry, Good $good) => $carry + $good->price * $cartItems[$good->id]['quantity']),
            'items' => $cartItems,
            'goods' => GoodResource::collection($goods),
        ];
    }
}
