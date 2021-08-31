<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Method to register user
     * @param Request $request Data of new user as json
     * @return \Illuminate\Http\JsonResponse Error or Success message
     */
    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'email' => 'required | unique:users,email'
        ]);

        if ($validator->fails()) {
            Log::channel('errorlog')->info('Someone registerd failed with error: '.$validator->getMessageBag(). ' with input', [
                'username' => $request->username,
                'password' => $request->password,
                'email' => $request->email,
            ]);

            return response()->json([
                'status'=>400,
                'validation_errors' => $validator->getMessageBag(),
            ]);

        } else { // insert into db
            $user = User::create([
                'Username' => $request->username,
                'Password' => $request->password,
                'Email' => $request->email,
            ]);

            Log::channel('syslog')->info('Someone registerd successfully with id'. $user->UserId);

            // create user token
            $token = $user->createToken($user->Email)->plainTextToken;

            Log::channel('syslog')->info('Auth token issued to user'. $user->UserId);

            // return success message
            return response()->json([
                'status' => 200,
                'username' => $user->Username,
                'token' => $token,
                'message' => 'register successfully'
            ]);

        }
    }

    /**
     * Method to login the user
     * @param Request $request Data of  user as json
     * @return \Illuminate\Http\JsonResponse Error or Success message
     */
    public function login(Request $request){

        $validator = Validator::make($request->all(), [
           'email'=> 'required',
            'password' => 'required'
        ]);

        // if input given incorrect e.g. missing an attribute
        if ($validator->fails()) {
            Log::channel('errorlog')->info('Someone login failed with error: '.$validator->getMessageBag(). ' with input', [
                'password' => $request->password,
                'email' => $request->email,
            ]);

            return response()->json([
                'status' => 400,
                'validation_errors' => $validator->getMessageBag(),
            ]);
        } else {
            // query db to data
            $user = User::where('email', $request->email)->where('password', $request->password)->first();

            if(! $user){ // if user not found
                Log::channel('errorlog')->info('Someone login failed with invalid credentials');

                return response()->json([
                    'status' => 401,
                    'errors' => 'Invalid Credentials',
                ]);

            } else { // create a token and return to user

                Log::channel('syslog')->info('User '. $user->UserId. ' login success');

                $token = $user->createToken($user->Email)->plainTextToken;

                Log::channel('syslog')->info('Auth token issued to user'. $user->UserId);

                return response()->json([
                    'status' => 200,
                    'username' =>$user->Username,
                    'token' => $token,
                    'message' => 'Logged in successfully'
                ]);

            }

        }
    }

    /**
     * Logout the user by deleting API token
     * @return \Illuminate\Http\JsonResponse success message
     */
    public function logout(){
        Log::channel('syslog')->info('User '. auth()->user()->UserId. ' logout success');

        auth()->user()->tokens()->delete(); // delete the user token
        return response()->json([
            'status'=> 200,
            'message'=> 'Logged out'
        ]);
    }
}
