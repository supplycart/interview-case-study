<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Log;

class UserController extends Controller
{

    public function register(Request $request)
    {
        try{
            $request->validate([
                'username' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);
    
            User::create([
                'name' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            dd("here");
    
            return redirect('/login')->with('success', 'Registration successful! Please log in.');

        }catch(Exception $e){
            Log::debug($e);
        }
    }

    public function login(Request $request){
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return redirect('/login')->with('error', 'Invalid credentials. Please try again.');
    }
}
