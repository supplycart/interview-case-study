<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Facades\Auth;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $price = $this->price;
        if (Auth::user()->role == 2) {
            $price *= 0.95;
            $price = round($price, 2);
        }
        $price = round($price, 2);
        return [
            "id" => $this->id,
            "name" => $this->name,
            "picture" => '/images/fakers/'.$this->picture,
            "cat_id" => $this->cat_id,
            "category" => $this->whenLoaded("category"),
            "price" => $price,
            "inventory" => $this->inventory,
            "description" => $this->description,
            "tags" => $this->tags
        ];
    }
}
