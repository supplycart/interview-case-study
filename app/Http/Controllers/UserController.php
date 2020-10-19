<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('index');
    }

    public function login(Request $request) {
        if ($request->has(['username', 'password']) === false) {
            abort(404);
        }

        $user = Users::where([
            'name' => $request->username,
            'password' => $request->password
        ])->first();

        if ($user === null) {
            abort(404);
        }

        $request->session()->put([
            'user_id' => $user->id
        ]);

        return redirect()->route('product_list');
    }

    public function register(Request $request) {
        if ($request->has(['username', 'email', 'password']) === false) {
            abort(404);
        }

        $isEmailExist = Users::where([
            'email' => $request->email
        ])->first();

        if ($isEmailExist !== null) {
            abort(404);
        }

        $user = new Users;
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        $request->session()->put([
            'user_id' => $user->id
        ]);

        return redirect()->route('product_list');
    }

    public function logout(Request $request) {
        $request->session()->flush();

        return redirect()->route('index');
    }
}
