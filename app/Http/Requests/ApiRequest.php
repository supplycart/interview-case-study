<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRequest extends FormRequest
{
    // override and return json error message 
    protected function failedValidation(Validator $validator) { 
        throw new HttpResponseException(
        response()->json([
            'status' => false,
            'messages' => $validator->errors()->all()
        ], 500)
        ); 
    }

}
