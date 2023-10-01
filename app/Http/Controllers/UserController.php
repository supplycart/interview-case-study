<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index() {
        return view('login');
    }

    public function register(RegisterRequest $request)
    {
        User::create([
            'name' => Faker::create()->name(),
            'email_address' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1
        ]);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt([
            'email_address' => $request->email,
            'password' => $request->password
        ], false)) {
            activity()->log('Logged In');
            
            $request->session()->regenerate();
            return response()->json([
                'message' => 'success',
            ])->setStatusCode(200);
        }

        return response()->json([
            'message'   => 'Invalid',
            'errors' => [
                'email' => ['Invalid login. Please try again.']
            ]
        ])->setStatusCode(422);
    }

    public function logout() {
        activity()->log('Logged Out');

        Session::flush();
        
        Auth::logout();

        return redirect('/');
    }

    public function changeRole(Request $request) {
        $request->validate([
            'role_id' => 'required|in:1,2,3'
        ]);

        Auth::user()->update([
            'role_id' => $request->get('role_id')
        ]);
    }
}
