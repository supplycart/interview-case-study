<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cardExpiration' => $this->date('cardExpiration')->format('m/y'),
            'saveInfo'       => $this->boolean('saveInfo'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'           => ['required', 'string', 'max:255'],
            'phone'          => ['required', 'string', 'max:255'],
            'email'          => ['required', 'email'],
            'cardNumber'     => ['required', 'numeric', 'digits:12'],
            'cardExpiration' => ['required', 'date_format:m/y'],
            'cardCvc'        => ['required', 'numeric', 'digits:3'],
            'address'        => ['required', 'string', 'max:255'],
            'city'           => ['required', 'string', 'max:255'],
            'state'          => ['required', 'string', 'max:255'],
            'zipCode'        => ['required', 'numeric', 'digits:5'],
            'saveInfo'       => ['required', 'boolean'],
        ];
    }
}
