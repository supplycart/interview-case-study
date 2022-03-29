<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->method() == "POST") {
            return true;
        }
        return false;
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json(
            [
                "code" => "UC001",
                "error" => "Unable to add user, something went wrong!",
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
            'username' => ["max:256"],
            'email' => ["max:256", "unique:users,email"],
            "phone_num" => ["max:16"],
            "password" => ["max:64"]
        ];

        if ($this->method() == "POST") {
            array_push($rules["username"], "required");
            array_push($rules["email"], "required");
            array_push($rules["phone_num"], "required");
            array_push($rules["password"], "required");
            $rules["address"] = "required";
        }

        return $rules;
    }
}
