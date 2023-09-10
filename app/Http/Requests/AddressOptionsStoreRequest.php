<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressOptionsStoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'addr1' => 'required',
            'addr2' => 'required',
            'city' => 'required',
            'postcode' => 'required',
            'country' => 'required',
        ];
    }
}
