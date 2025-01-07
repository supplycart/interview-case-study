<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function viewRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully. Please log in.');
    }

    public function viewLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); //create token
            ActivityLogger::log(auth()->user(), 'Login', 'Login');
            return redirect()->intended('/products')->with('success', 'Logged in successfully!');
        }

        return back()->withErrors([
            'email' => 'Wrong password or userna.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        ActivityLogger::log(auth()->user(), 'Logout', 'Logout');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); //delete token

        return redirect('/login')->with('success', 'Logged out successfully!');
    }

}
