<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Product|ProductResource $this */

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'brand' => new BrandResource($this->whenLoaded('brand')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'price' => $this->whenLoaded('price', function () {
                return $this->resource->price->amount;
            }),
        ];
    }
}
