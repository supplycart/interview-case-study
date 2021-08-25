<?php

namespace App\Http\Controllers;

use Hash;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    /**
     * Get the view for login page.
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Validate login request. Redirect to dashboard page if
     * login details are valid, else redirect back to login 
     * page.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function customLogin(Request $request)
    {
        // Validate if required inputs are given
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // Authenticate user
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            session()->flash('success', 'Logged in Successfully!');
            return redirect('dashboard');
        }

        session()->flash('error', 'Login details are invalid');
        return redirect('login');
    }

    /**
     * Get the view for registration page.
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * Validate registration request. Redirect to login page 
     * if registration details are valid.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function customRegistration(Request $request)
    {  
        // Validate if inputs are given and in correct format
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        
        // Store user data
        $data = $request->all();
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        
        session()->flash('success', 'Registered Successfully!');
        return redirect('login');
    }   

    /**
     * Sign out and redirect to login page.
     */
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        session()->flash('success', 'Logged Out Successfully!');
        return redirect('login');
    }

}
