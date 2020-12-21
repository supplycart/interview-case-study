<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProductFilterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cat_ids'   => 'array',
            'brand_ids' => 'array',
        ];
    }

    public function data()
    {
        return [
            'category_id' => $this->cat_ids ?: [],
            'brand_id'    => $this->brand_ids ?: [],
        ];
    }
}
