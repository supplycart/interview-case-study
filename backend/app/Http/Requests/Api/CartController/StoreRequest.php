<?php

namespace App\Http\Requests\Api\CartController;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            '*.product_id' => ['required', 'integer', 'exists:products,id'],
            '*.quantity' => ['required', 'integer', 'min:0'],
        ];
    }
}
