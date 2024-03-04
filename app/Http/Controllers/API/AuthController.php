<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Request\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;

class AuthController
{
    public function __construct(UserRepository $UserRepository) {
        $this->_userRepository = $UserRepository;
    }

    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;

        $user = $this->_userRepository->getActiveUser($username);
        $ban_user = $this->_userRepository->getBannedUser($username);

        if($ban_user){
            return 'The User banned due to'.$ban_user->reason;
            throw new \Exception(__("The User banned due to ".$ban_user->reason));
        }

        if($user){
            if(Auth::guard('api')->attempt(['username' => $username, 'password' => $password, 'status' => 1])) {
                // if new agent, generate a session id
                if($user->session_id == null) {
                    $session_id = $this->_userRepository->updateSessionIDByUserID($user->id);
                    $user->session_id = $session_id;
                }

                return response()->json(['data' => $user], 200);
            }else{
                return response()->json(['data' => __("page.incorrect_password")], 404);
            }
        }else{
            $user = $this->_userRepository->getInactiveUserByUsername($username);

            if ($user) {
                throw new \Exception(__("page.contact_admin_active"));
            }else{
                throw new \Exception(__("page.no_user"));
            }
        }
    }

    public function register(Request $request){
        $validation = $request->validate([
            'username' => [
                'required',
                'min:5',
                'max:15',
                function ($attribute, $value, $fail) {
                    // check unique validation
                    $user = User::where($attribute, $value)
                        ->where(function ($query) {
                            $query->where('status', 1)
                                ->orWhere('status', 0);
                        })
                        ->first();

                    if ($user != null) {
                        $fail($attribute . ' has to be unique');
                    }

                    // check username format, alpha num and underscore only
                    if (!preg_match("/^[a-zA-Z0-9_\-]*$/", $value)) {
                        $fail($attribute . ' has to be a combination of alphabet letters, numbers, and _ only');
                    }
                },
            ],
            'password' => 'required|min:6|confirmed',
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    $user = User::where($attribute, $value)
                        ->where(function ($query) {
                            $query->where('status', 1)
                                ->orWhere('status', 0);
                        })
                        ->first();

                    if ($user != null) {
                        $fail($attribute . ' has to be unique');
                    }
                },
            ],
        ]);

        $user_id = generate_unique_id('USER-', "User", "user_id");
        $request->offsetSet('password', Hash::make($request->input("password")));

        $new_user = new User;
        $new_user->fill($request->input());

        $new_user->username = $request['username'];
        $new_user->user_id = $user_id;
        $new_user->status = 0;

        $new_user->save();

        return response()->json(['data' => true], 200);
    }
}
