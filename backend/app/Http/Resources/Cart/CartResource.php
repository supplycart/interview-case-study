<?php

namespace App\Http\Resources\Cart;

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
            'id' => $this->CartId,
            'product_id' => $this->ProductId,
            'status' => $this->Status,
            'user_id'=> $this->UserId,
            'quantity' =>$this->Quantity,
            'cost' => $this->cost
        ];
    }
}
