<?php

namespace App\Http\Resources;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            $subtotal = number_format((float) $this->subtotal * Product::CURRENCY_EUR_RATE, 2, '.', '');
            $delivery = number_format((float) $this->delivery * Product::CURRENCY_EUR_RATE, 2, '.', '');
            $discount = number_format((float) $this->discount * Product::CURRENCY_EUR_RATE, 2, '.', '');
            $total = number_format((float) $this->total * Product::CURRENCY_EUR_RATE, 2, '.', '');
            $sign = Product::CURRENCY_EUR_SIGN;
        } else {
            $subtotal = $this->subtotal;
            $delivery = $this->delivery;
            $discount = $this->discount;
            $total = $this->total;
            $sign = Product::CURRENCY_MYR_SIGN;
        }

        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'subtotal' => $subtotal,
            'delivery' => $delivery,
            'discount' => $discount,
            'total' => $total,
            'sign' => $sign,
            'products' => OrderProductResource::collection($this->products),
            'created_at' => Carbon::parse($this->created_at)->toFormattedDateString()
        ];
    }
}
