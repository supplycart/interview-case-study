<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json(
            [
                "code" => "CC001",
                "error" => "Unable to add into cart, something went wrong!",
                "xxx" => $validator->errors()
            ], 400));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            "product_id" => ["exists:products,id"],
            "quantity" => ["integer"],
        ];

        if ($this->method() == "POST") {
            array_push($rules["product_id"], "required");
            array_push($rules["quantity"], "required");
        }
        return $rules;
    }
}
