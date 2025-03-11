<?php

namespace App\Http\Controllers\API;

use App\Actions\Modules\General\Authentication\GetAuthenticatedUserAction;
use App\Actions\Modules\General\Authentication\LoginAction;
use App\Actions\Modules\General\Authentication\LogoutAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $token = LoginAction::execute($request);

        return ['access_token' => $token->plainTextToken];
    }

    public function logout(Request $request)
    {
        LogoutAction::execute($request);

        return [ 'message' => 'Tokens and currentAccessToken deleted. Please login to obtain a new token.' ];
    }

    public function user()
    {
        $user = GetAuthenticatedUserAction::execute();

        return $user;
    }
}
