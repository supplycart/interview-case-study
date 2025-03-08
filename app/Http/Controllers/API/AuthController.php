<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $token = $request->user()->createToken('api-token');

        return ['access_token' => $token->plainTextToken];
    }

    public function logout(Request $request)
    {
        // delete all tokens, essentially logging the user out
        auth()->user()->tokens()->delete();

        // delete the current token that was used for the request
        $request->user()->currentAccessToken()->delete();

        return [ 'message' => 'Tokens and currentAccessToken deleted. Please login to obtain a new token.' ];
    }

    public function user(Request $request)
    {
        $data = [];
        $data['request->user()'] = $request->user();
        $data['auth()->user()'] = auth()->user();

        return $data;
    }
}
