<?php

namespace App\Actions\Modules\General\Authentication;

use App\Http\Requests\Auth\LoginRequest;

class LoginAction
{
    public static function execute(LoginRequest $request)
    {
        $request->authenticate();

        $token = $request->user()->createToken('api-token');

        return $token;
    }
}
