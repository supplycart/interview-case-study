<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AttributeValueCollection; // For bonus
use App\Services\ProductService;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $user = $request->user();
        $price = $this->price_in_cents;

        // Bonus: Apply differential pricing if user is authenticated
        if ($description = $this->whenLoaded('userSpecificPrices', function () use ($user) {
            // This assumes userSpecificPrices relationship exists and is loaded.
            // A more robust way is to call a service method like in ProductService
            if ($user) {
                $specificPrice = $this->userSpecificPrices->where('user_id', $user->id)->first();
                return $specificPrice ? $specificPrice->price_in_cents : null;
            }
            return null;
        })) {
            $price = $description; // This logic might need to be refined based on how userSpecificPrices are loaded.
            // Better to have a dedicated price method in model or service.
        } else if ($user) { // Fallback if 'userSpecificPrices' isn't loaded but user exists
            $productService = app(ProductService::class);
            $price = $productService->getProductPriceForUser($this->resource, $user);
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price_in_cents' => $price, // Apply differential price here
            'formatted_price' => '$' . number_format($price / 100, 2),
            'stock_quantity' => $this->stock_quantity,
            // Bonus: Include attributes if the 'attributeValues' relationship is loaded
            // Here, AttributeValueResource::collection will be used directly without the 'data' wrapper
            // from AttributeValueCollection if $this->whenLoaded('attributeValues') returns an Eloquent Collection.
            // If it returned a Paginator, then AttributeValueCollection could be used with its structure.
            // Usually for related items, it's an Eloquent Collection.
            'attributes' => AttributeValueResource::collection($this->whenLoaded('attributeValues')),

            // If you wanted the structure of AttributeValueCollection (e.g., with its own 'data' key)
            // 'attributes_structured' => new AttributeValueCollection($this->whenLoaded('attributeValues')),
            // but this is less common for nested related resources.

            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}
