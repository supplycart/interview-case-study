<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddedProductCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'product_prices_id' => ['required', 'exists:products,id']
        ];
    }
}
