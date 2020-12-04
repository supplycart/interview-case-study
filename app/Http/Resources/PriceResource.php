<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "product_id" => $this->product_id,
            "price" => $this->price,
            "is_default" => $this->is_default,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
