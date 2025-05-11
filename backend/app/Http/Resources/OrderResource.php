<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_number' => 'ORD-' . str_pad($this->id, 6, '0', STR_PAD_LEFT),
            'user_id' => $this->user_id,
            'total_amount_in_cents' => $this->total_amount_in_cents,
            'formatted_total_amount' => '$' . number_format($this->total_amount_in_cents / 100, 2),
            'status' => $this->status,
            'order_date' => $this->created_at->toFormattedDateString(),
            'created_at' => $this->created_at->toIso8601String(),
            'items' => OrderItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
