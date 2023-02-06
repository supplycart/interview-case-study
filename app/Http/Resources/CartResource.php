<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

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
            'id' => $this->id,
            'user_id'=>$this->user_id,
            'product_id' => $this->product_id,
            'product_image' => $this->product_image,
            'product_name' => $this->product_name,
            'product_price'=>$this->product_price,
            'quantity'=>$this->quantity,
            'selected'=>1,
        ];
    }
}