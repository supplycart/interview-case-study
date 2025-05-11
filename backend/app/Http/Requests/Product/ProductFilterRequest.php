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
            'category_slug' => ['nullable', 'string', 'max:255', 'exists:categories,slug'], // Validate slug exists
            'brand_slug' => ['nullable', 'string', 'max:255', 'exists:brands,slug'],       // Validate slug exists
            'min_price' => ['nullable', 'integer', 'min:0'],
            'max_price' => ['nullable', 'integer', 'min:0', 'gte:min_price'],
            // Ensure 'stock_quantity' is a reasonable sort option if applicable, otherwise remove
            'sort_by' => ['nullable', 'string', 'in:name,price_in_cents,created_at,updated_at'],
            'sort_direction' => ['nullable', 'string', 'in:asc,desc'],
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
            // Rule for filtering by multiple attribute_value_ids
            'attribute_value_ids' => ['nullable', 'array'],
            'attribute_value_ids.*' => ['required', 'integer', 'exists:attribute_values,id'],
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
