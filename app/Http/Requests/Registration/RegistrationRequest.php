<?php

namespace App\Http\Requests\Registration;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistrationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'unique:users',
                'string',
                'lowercase',
                'email',
                'max:255',
            ],
            'password' => ['required', 'string', 'max:255', 'confirmed'],
        ];
    }
}
