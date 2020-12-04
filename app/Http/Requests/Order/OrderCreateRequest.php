<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'products' => ['required'],
            'products.*.id' => ['required', 'exists:products,id'],
            'products.*.price_id' => ['required', 'exists:product_prices,id'],
            'products.*.amount' => ['required', 'integer'],
        ];
    }
}
