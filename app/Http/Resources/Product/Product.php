<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Brand\Brand;
use App\Http\Resources\Category\Category;

class Product extends JsonResource
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
            'quantity' => $this->quantity,
            'price' => $this->price,
            'picture' => $this->picture,
            'brand' => Brand::make($this->whenLoaded('brand')),
            'categories' => Category::collection($this->whenLoaded('categories'))
        ];
    }
}
