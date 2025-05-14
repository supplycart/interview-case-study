<?php

namespace App\Http\Resources;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Cart|CartResource $this */
        return [
            'items' => new CartItemCollection($this->whenLoaded('items')),
            'updated_at' => $this->updated_at,
        ];
    }
}
