<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "product_id" => $this->product_id,
            "quantity" => $this->quantity,
            "order_id" => $this->order_id,
            "status" => $this->status,
            "product" => new ProductResource($this->whenLoaded("product"))
        ];
    }
}
