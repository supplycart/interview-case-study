<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required',
            'email'    => 'required|unique:users|email:rfc',
//            'email'         => 'required|unique:customers|email:rfc,dns',
            'password' => 'required|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name field is required.',
        ];
    }

    public function customer()
    {
        return [
            'name'     => $this->name,
            'password' => $this->password,
            'email'    => $this->email,
        ];
    }

}
