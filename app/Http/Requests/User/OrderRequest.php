<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => [ 'required', 'exists:users,id' ],
            'cart_item_ids' => [ 'required' ],
            'cart_item_ids.*' => [ 'required', 'exists:cart_items,id' ],
        ];
    }
}
