<?php

namespace App\Http\Requests\Api\AuthController;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class VerifyEmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        $user = User::find((string) $this->route('id'));

        if (!$user) {
            return false;
        }

        if (!hash_equals(sha1($user->getEmailForVerification()), (string)$this->route('hash'))) {
            return false;
        }

        $this->setUserResolver(function () use ($user) {
            return $user;
        });

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
