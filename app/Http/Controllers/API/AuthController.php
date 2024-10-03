<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Requests\API\LoginRequest;
use App\Http\Requests\API\ForgetPasswordRequest;
use App\Models\User;
use App\Models\UserLog;
use App\Mail\ResetPassword;
use App\Http\Requests\API\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Hash;

class AuthController
{
    public function __construct(UserRepository $userRepository) {
        $this->_userRepository = $userRepository;
    }

    public function login(LoginRequest $request){
        $username = $request->username;
        $password = $request->password;
        
        $token = Auth::guard('api')->attempt(['username' => $username, 'password' => $password, 'status' => 1]);

        if (!$token) {
            return response()->json(['messages' => ['Incorrect Password']], 401);
        }

        $user = $this->_userRepository->getActiveUser($username);
        $ban_user = $this->_userRepository->getBannedUser($username);

        if($ban_user){
            return 'The User banned due to'.$ban_user->reason;
            throw new \Exception(__("The User banned due to ".$ban_user->reason));
        }

        if($user){
            $user->token = $token;

            activity()
                ->log($user->id, 'User Login');

            return response()->json(['data' => $user], 200);
        }else{
            $user = $this->_userRepository->getInactiveUserByUsername($username);

            if ($user) {
                return response()->json(['data' => __("page.contact_admin_active")], 404);
                // throw new \Exception(__(""));
            }else{
                return response()->json(['data' => 'no user'], 404);
            }
        }
    }

    public function getUser($id){
        $user = User::find($id);

        return response()->json(['data' => $user], 200);
    }

    public function updateUser(Request $request, $id){

        User::where('id', $id)
            ->update(
                $request->all()
            );

        activity()
            ->log($id, 'User profile update');

        $user = User::find($id);

        return response()->json(['data' => $user], 200);
    }

    public function createUser(RegisterRequest $request){
        $user_id = generate_unique_id('USER-', "User", "user_id");
        $request->offsetSet('password', Hash::make($request->input("password")));
        
        try {
            $new_user = new User;
            $new_user->fill($request->input());

            $new_user->username = $request['username'];
            $new_user->user_id = $user_id;
            $new_user->status = 1;
            $new_user->save();

            $new_user->sendEmailVerificationNotification();

            activity()
                ->log($new_user->id, 'Registered');

            return response()->json(['data' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['messages' => $e->getMessage()], 404);
        }
        
    }

    public function forgetPassword(Request $request){
        $email = $request->email;
        $user = User::where('email', $email)->first();

        if(!$user){
            return response()->json(['data' => __("auth.no_email")], 404);
        }

        $token = Str::random(80);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email], 
            ['token' => $token, 'user_id' => $user->id, 'email' => $email]
        );

        Mail::to($email)->send(new ResetPassword($token));
        return response()->json(['data' => __("password.sent")], 200);
    }

    public function getPasswordLink(ForgetPasswordRequest $request){
        $token = $request->token;
        $password = $request->password;

        $password_reminder = DB::table('password_reset_tokens')
            ->where(['token' => $token])
            ->first();

        if($password_reminder){
            $new_password = bcrypt($password);
            User::where('id', $password_reminder->user_id)
                ->update(['password' => $new_password]);
        }else{
            return response()->json(['data' => __("password.contact_admin")], 404);
        }

        return response()->json(['data' => __("password.done")], 200);
    }

    public function logout(){

        activity()
            ->log(Auth::user()->id, 'User Logout');
        
        Auth::guard('api')->logout();

        return response()->json(['data' => 'done'], 200);
    }
}
