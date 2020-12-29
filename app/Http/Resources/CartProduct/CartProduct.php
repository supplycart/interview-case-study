<?php

namespace App\Http\Resources\CartProduct;

use Illuminate\Http\Resources\Json\JsonResource;

class CartProduct extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            // 'product_quantity' => $this->whenPivotLoaded('cart_product', function () {
            //     return $this->pivot->product_quantity;
            // }),
            'price' => $this->price,
            'total_price' => $this->price,
            'picture' => $this->picture,
            'brand' => Brand::make($this->whenLoaded('brand')),
        ];
    }
}
