<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public static $wrap = 'data'; // Standard wrapper

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => ProductResource::collection($this->collection),
            // Pagination links and meta are automatically added by Laravel
            // when a LengthAwarePaginator instance is passed to a ResourceCollection.
        ];
    }
}
