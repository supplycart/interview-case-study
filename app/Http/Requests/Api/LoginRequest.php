<?php

namespace App\Http\Requests\Api;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password'      => 'required',
            'email'         => 'required',
        ];
    }

    public function messages()
    {


        return [
            'name.required' => 'Name field is required.',
//            'email.unique' => 'Name field is required.',
        ];
    }

    public function credentials()
    {
        if ($this->email) {
            $data["email"] = $this->email;
        }
        $data["password"] = $this->password;

        return $data;
    }
}
