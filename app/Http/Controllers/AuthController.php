<?php

namespace App\Http\Controllers;

use App\Models\UserHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, ], $request->remember)) {
            $user = Auth::user();

            UserHistory::create([
                "user_id" => $user->id,
                "type" => 1
            ]);

            return response($user, 200);
        }

        return response([
            "error" => [
                "code"=>"AUT001",
                "message"=>"Incorrect email or password."
            ]
        ], 401);
    }

    public function authenticated() {
        if (Auth::user()) {
            return response(Auth::user(), 200);
        }
        return response(false, 400);
    }

    public function logout() {
        UserHistory::create([
            "user_id" => Auth::user()->id,
            "type" => 2
        ]);
        Auth::logout();
        return response(true, 200);
    }
}
