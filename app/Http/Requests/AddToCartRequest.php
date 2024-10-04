<?php

namespace App\Http\Requests;

use App\Helpers\MasterLookupHelper;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddToCartRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $productStatus = MasterLookupHelper::getKeyByLookUpType('product_status');

        return [
            'product_id' => [
                'required',
                Rule::exists('products', 'id')
                    ->where(
                        fn (Builder $query) => $query
                            ->where('stock', '>', 0)
                            ->where('status_id', $productStatus['active'])
                    )
            ],
            'quantity' => ['required', 'integer'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'product_id' => $this->integer('product_id'),
            'quantity'   => $this->integer('quantity'),
        ]);
    }
}
