<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'price' => $this->whenLoaded('price'),
            'amount' => $this->amount,
            'product' => $this->whenLoaded('product'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
