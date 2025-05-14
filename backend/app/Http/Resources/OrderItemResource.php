<?php

namespace App\Http\Resources;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var OrderItem|OrderItemResource $this */
        return [
            'product_id' => $this->product_id,
            'product_name' => $this->product_name,
            'brand_name' => $this->brand_name,
            'category_name' => $this->category_name,
            'price_amount' => $this->price_amount,
            'quantity' => $this->quantity,
            'total' => $this->total,
        ];
    }
}
