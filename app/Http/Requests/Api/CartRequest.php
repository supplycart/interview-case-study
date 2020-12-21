<?php

namespace App\Http\Requests\Api;

use App\Models\Cart;
use App\Models\OutletProduct;
use App\Models\ProductStock;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required|numeric|exists:products,id',
            'quantity'   => 'numeric',
        ];
    }

    public function data()
    {
        $data = [
            'product_id' => $this->product_id,
            'user_id'    => $this->user()->id,
        ];


        return $data;
    }
}
