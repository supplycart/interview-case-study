<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    // preserver PK
    public $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
         return [
            'id' => $this->ProductId,
            'name' => $this->Name,
            'stock' => $this->Stock == 0 ? 'Out of Stock' : $this->Stock, // return out of stock if stock==0
            'detail' => $this->Detail,
            'img' => $this->Img,
             'stock' => $this->Stock,
            'price' => $this->Price
        ];
    }
}
