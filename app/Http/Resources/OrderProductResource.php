<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ( isset($request->currency) && $request->currency == Product::CURRENCY_EUR ) {
            if ($this->pivot) {
                $price = number_format((float) $this->pivot->price * Product::CURRENCY_EUR_RATE, 2, '.', '');
            } else {
                $price = number_format((float) $this->price * Product::CURRENCY_EUR_RATE, 2, '.', '');
            }
            $count = ($this->pivot) ? $this->pivot->count : 0;
            $total = number_format((float) $price * $count, 2, '.', '');
            $sign = Product::CURRENCY_EUR_SIGN;
        } else {
            if ($this->pivot)
                $price = $this->pivot->price;
            else
                $price = $this->price;
            $count = ($this->pivot) ? $this->pivot->count : 0;
            $total = number_format((float) $price * $count, 2, '.', '');
            $sign = Product::CURRENCY_MYR_SIGN;
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $price,
            'sign' => $sign,
            'image_url' => $this->image_url,
            'count' => $count,
            'total' => $total
        ];
    }
}
