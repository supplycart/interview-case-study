<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => new PriceResource($this->getPrice($this->whenLoaded('prices'))),
            'brand' => $this->whenLoaded('brand'),
            'category' => $this->whenLoaded('category'),
            'stock' => $this->stock,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }


    /**
     * @param Collection $prices
     */
    private function getPrice($prices)
    {
        $price = $prices->filter(function($item) {
            return $item->countries->isNotEmpty();
        })->filter(function ($item) {
            return $item['countries']->pluck('country')->contains(auth()->user()['country_code']);
        })->first();

        if (!$price) return $prices->where('is_default', true)->first();

        return $price;
    }
}
