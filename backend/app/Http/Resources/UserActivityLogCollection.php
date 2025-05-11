<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserActivityLogCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public static $wrap = 'data';

    // public $collects = UserActivityLogResource::class; // Optional

    /**
     * Transform the resource collection into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Laravel's default behavior handles pagination metadata automatically.
        return parent::toArray($request);
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
                'collection_type' => 'user_activity_logs',
            ],
        ];
    }
}
