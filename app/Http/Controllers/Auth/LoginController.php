<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    // public function requestLogin() {
    //     return view('auth.login');
    // }

    public function authUser(Request $request) {
        return $request->user();
    }
}
