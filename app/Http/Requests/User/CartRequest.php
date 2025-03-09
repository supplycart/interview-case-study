<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CartRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => [ 'required', 'exists:products,id' ],
            'product_title' => [ 'required' ],
            'product_description' => [ 'required' ],
            'quantity' => [ 'required' ],
            'unit_price' => [ 'required' ],
        ];
    }
}
