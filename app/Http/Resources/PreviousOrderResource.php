<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PreviousOrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'price' => $this->whenLoaded('price'),
            'amount' => $this->amount,
            'total' => $this->total,
            'order_id' => $this->order_id,
            'current_price' => $this->current_price,
            'product' => $this->whenLoaded('product'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
