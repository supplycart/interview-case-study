<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'total_price' => $this->total_price,
            'ordered_products' => PreviousOrderResource::collection($this->whenLoaded('orderedProducts')),
            'created_at' => $this->created_at
        ];
    }
}
