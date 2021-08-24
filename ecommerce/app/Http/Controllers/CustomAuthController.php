<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
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
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                            ->withSuccess('Signed in');
        }
        return redirect('login')->withSuccess('Login details are invalid');
    }

    /**
     * Get the view for registration page.
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * Validate registration request. Redirect to dashboard page 
     * if registration details are valid.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect('dashboard')->withSuccess('You have signed-in');
    }   

    
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    
    /**
     * Sign out and redirect to login page.
     */
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return redirect('login');
    }

}
