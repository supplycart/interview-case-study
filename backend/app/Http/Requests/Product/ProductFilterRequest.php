<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Authenticated users can view products
    }

    /**
     * Get the validation rules that apply to the request.
     * These are query parameters.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'string', 'max:100'], // Or 'integer', 'exists:categories,id' if using IDs
            'brand' => ['nullable', 'string', 'max:100'],    // Or 'integer', 'exists:brands,id'
            'min_price' => ['nullable', 'integer', 'min:0'],
            'max_price' => ['nullable', 'integer', 'min:0', 'gte:min_price'],
            'sort_by' => ['nullable', 'string', 'in:name,price_in_cents,created_at,stock_quantity'],
            'sort_direction' => ['nullable', 'string', 'in:asc,desc'],
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
            // Example for attribute filtering if attributes are passed as an array:
            // 'attributes' => ['nullable', 'array'],
            // 'attributes.*.id' => ['required_with:attributes', 'integer', 'exists:attributes,id'],
            // 'attributes.*.value' => ['required_with:attributes', 'string'], // or 'array' for multiple values
        ];
    }

    /**
     * Prepare the data for validation.
     * Cast numeric query params to integers.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'min_price' => $this->min_price ? (int) $this->min_price : null,
            'max_price' => $this->max_price ? (int) $this->max_price : null,
            'page' => $this->page ? (int) $this->page : null,
            'per_page' => $this->per_page ? (int) $this->per_page : 15, // Default per_page
        ]);
    }
}
