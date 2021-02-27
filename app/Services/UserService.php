<?php

namespace App\Services;

use App\Models\User;
use \Exception;
use Illuminate\Support\Facades\Hash;

class UserService
{

    /**
     * @param $request
     * @return mixed
     */
    public function getUserToken($request)
    {
        try {
            $request->user()->tokens()->delete();
            return $request->user()->createToken('token-name');
        } catch (Exception $e) {
            return null;
        }
    }

    public function getUserForCheckout($request)
    {
        if ($request->is_create_account == User::CREATE_ACCOUNT) {
            $user = User::create([
                'name' => $request->firstname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else if ($request->is_create_account == User::ISSET_ACCOUNT) {
            $user = User::where('email', $request->email)->first();
        } else {
            $user = null;
        }

        return $user;
    }


}
