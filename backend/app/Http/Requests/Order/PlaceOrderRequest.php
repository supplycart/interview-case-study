<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SufficientStock; // Custom rule

class PlaceOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() != null; // Only authenticated users can place orders
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => [
                'required',
                'integer',
                'exists:products,id',
                // Pass quantity to SufficientStock rule for the specific product
                // new SufficientStock($this->input('items.*.quantity')) // This is tricky with wildcard
            ],
            'items.*.quantity' => ['required', 'integer', 'min:1'],

            // Additional custom rule for each item to check stock.
            // This is applied after individual field validations.
            'items.*' => [new SufficientStock()],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'items.required' => 'Your cart cannot be empty.',
            'items.*.product_id.exists' => 'One or more products in your cart are invalid or no longer available.',
            'items.*.quantity.min' => 'Product quantity must be at least 1.',
        ];
    }
}
