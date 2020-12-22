<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{


    //register api
    public function register(RegisterRequest $request)
    {
        $input             = $request->customer();
        $input['password'] = bcrypt($input['password']);
        $user              = User::create($input);
        $success['token']  = $user->createToken('Personal Access Token')->accessToken;
        $success['user']   = $user;

        if (env("MAIL_USERNAME")) {
            $user->sendEmailVerificationNotification();
        }

        return response()->json(
            [
                "status"  => true,
                "data"    => $success,
                "message" => "Register is success",
            ]
        );
    }

    //Login api
    public function login(LoginRequest $request)
    {
        $credential = $request->credentials();
        $success    = [];
        if (auth()->attempt($credential)) {
            $user             = auth()->user();
            $token            = $user->createToken('LoginToken');
            $success['token'] = $token->accessToken;
            $success['token'] = $token->plainTextToken;
            $success['user']  = $user;
            if (!$user->email_verified_at) {
                return response()->json(
                    [
                        "status"  => false,
                        "errors"  => true,
                        'message' => 'Please verify your email address first',
                    ],
                    400
                );
            }
            activity()->withProperties(['user_agent' => $request->header('User-Agent')])->log('login');

            return response()->json(
                [
                    "status"  => true,
                    "data"    => $success,
                    "token"   => $token->plainTextToken,
                    "message" => "Login success",
                ],
                200
            );
        } else {
            return response()->json(
                [
                    "status"  => false,
                    'message' => 'Invalid password or username',
                ],
                400
            );
        }
    }

    // user detail api
    public function user()
    {
        $user = Auth::user();

        return response()->json(["status" => true, 'data' => $user, "message" => "Data retrieved"], 200);
    }


    //logout API
    public function logout()
    {
        // Get user who requested the logout
        activity()->withProperties(['user_agent' => request()->header('User-Agent')])->log('logout');

        $user = request()->user();
        // Revoke current user token
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return response()->json(["status" => true, 'data' => [], "message" => "successfully logout"]);
    }

}
