<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public static $wrap = 'data'; // Wraps the collection under a 'data' key, standard practice.

    // public $collects = OrderResource::class; // Optional: Explicitly define collected resource (good for static analysis)

    /**
     * Transform the resource collection into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // When a paginator instance (like LengthAwarePaginator) is passed to
        // a ResourceCollection, Laravel automatically includes pagination
        // links and meta information in the response.
        // The actual transformation of each item is handled by OrderResource.
        return parent::toArray($request);

        // If you don't want Laravel's default pagination structure, you can customize it:
        // return [
        //     'data' => OrderResource::collection($this->collection),
        //     'links' => [
        //         'first' => $this->url(1),
        //         'last' => $this->url($this->lastPage()),
        //         'prev' => $this->previousPageUrl(),
        //         'next' => $this->nextPageUrl(),
        //     ],
        //     'meta' => [
        //         'current_page' => $this->currentPage(),
        //         'from' => $this->firstItem(),
        //         'last_page' => $this->lastPage(),
        //         'path' => $this->path(),
        //         'per_page' => $this->perPage(),
        //         'to' => $this->lastItem(),
        //         'total' => $this->total(),
        //     ],
        // ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with(Request $request)
    {
        return [
            'meta' => [
                'collection_type' => 'orders',
                // Add any other global meta information for this collection
            ],
        ];
    }
}
