<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandResource extends JsonResource
{
    /** @mixin Brand */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'url' => $this->url,
            'logo' => $this->logo,

            'goods' => GoodResource::collection($this->whenLoaded('goods')),
        ];
    }
}
