<?php

namespace App\Http\Resources\Order;

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
        //TODO: add date order was created

        return [
            'id' => $this->OrderId,
            'cost' => $this->Cost,
            'product_name'=>$this->Name,
            'price'=> $this->Price,
            'img'=>$this->Img,
            'quantity'=>$this->Quantity,
        ];
    }
}
