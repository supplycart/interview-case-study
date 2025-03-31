<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    function loginPost(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        $credentials = $request->only("email", "password");
        if(Auth::attempt($credentials))
        {
            return redirect()->intended(route("home"));
        }
        return redirect(route("login"))
            ->with("error", "Wrong credentials entered");
    }

    function register()
    {
        return view('auth.register');
    }

    function registerPost(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required",
            "password" => "required"
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if($user->save())
        {
            return redirect(route("login"))
                ->with("success", "Account created successfully!");
        }
        return redirect(route("register"))
            ->with("error", "Failed to create account");
    }
}
