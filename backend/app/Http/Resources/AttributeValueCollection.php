<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AttributeValueCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public static $wrap = 'data'; // Or null if you don't want to wrap when used inside another resource

    // public $collects = AttributeValueResource::class; // Optional

    /**
     * Transform the resource collection into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // If this collection is used for a paginated result (e.g., listing all attribute values globally),
        // then parent::toArray($request) is fine.
        // However, if it's used within another resource (like ProductResource) to list
        // related attribute_values, which is usually not paginated in that context,
        // you might just want the raw collection transform.
        //
        // This setup assumes it could be used for both.
        // When used with a non-paginated Illuminate\Database\Eloquent\Collection,
        // the pagination keys ('links', 'meta') won't be present.

        return parent::toArray($request);

        // Alternative if you *always* want just the items without top-level 'data' or pagination:
        // return $this->collection->map(function ($item) use ($request) {
        //     return (new AttributeValueResource($item))->toArray($request);
        // })->all();
    }

    /**
     * Get additional data that should be returned with the resource array.
     * Only applies if this collection itself is the top-level response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with(Request $request)
    {
        // This 'with' data will only be added if AttributeValueCollection is the primary resource
        // being returned from a controller action directly with pagination.
        // If it's used like `new AttributeValueCollection($product->attributeValues)` inside ProductResource,
        // this 'with' data will not appear at the ProductResource level.
        if ($this->resource instanceof \Illuminate\Pagination\AbstractPaginator) {
            return [
                'meta' => [
                    'collection_type' => 'attribute_values',
                ],
            ];
        }
        return [];
    }
}
