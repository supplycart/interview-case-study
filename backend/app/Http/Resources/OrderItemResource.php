<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'product_name' => $this->whenLoaded('product', $this->product->name, null), // Eager load 'product'
            'quantity' => $this->quantity,
            'price_at_purchase_in_cents' => $this->price_at_purchase_in_cents,
            'formatted_price_at_purchase' => '$' . number_format($this->price_at_purchase_in_cents / 100, 2),
            'line_total_in_cents' => $this->price_at_purchase_in_cents * $this->quantity,
            'formatted_line_total' => '$' . number_format(($this->price_at_purchase_in_cents * $this->quantity) / 100, 2),
        ];
    }
}
