<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AttributeValueResource;
use App\Services\ProductService;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $request->user();
        $price = $this->price_in_cents; // Start with the base price

        // Use ProductService to get the correct price based on the user
        $productService = app(ProductService::class);
        $price = $productService->getProductPriceForUser($this->resource, $user);


        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'description' => $this->description,
            'price_in_cents' => $price, // Use the calculated effective price
            'formatted_price' => '$' . number_format($price / 100, 2),
            'stock_quantity' => $this->stock_quantity,
            'attributes' => AttributeValueResource::collection($this->whenLoaded('attributeValues')),
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}
