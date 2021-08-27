<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // controller to register
    public function register(Request $req) {
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'email' => 'required|email|max:191|uinuqe:users,email',
            'password' => 'required'
        ]);

        if($validator->fails()){  //validation fail
            return response()->json([
                'validation_errors' => $validator->message(),
            ]);
        } else { // validation success

            $user = User::create([
                'name' => $req->name,
                'email' => $req->email,
            ]);
        }
    }
}
