<?php

namespace App\Http\Resources;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var CartItem|CartResource $this */
        return [
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'product' => new ProductResource($this->whenLoaded('product')),
            'updated_at' => $this->updated_at,
        ];
    }
}
