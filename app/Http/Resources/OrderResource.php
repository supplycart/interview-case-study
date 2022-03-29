<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "address" => $this->address,
            "phone_num" => $this->phone_num,
            "voucher_id" => $this->voucher_id,
            "carts" => CartResource::collection($this->whenLoaded('relatedCarts')),
            "created_at" => $this->created_at,
            "payment" => $this->payment,
            "voucher" => $this->whenLoaded("connectedVoucher")
        ];
    }
}
