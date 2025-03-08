<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $token = $request->user()->createToken('api-token');

        return ['access_token' => $token->plainTextToken];
    }
}
