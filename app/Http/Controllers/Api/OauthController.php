<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class OauthController
 * @package App\Http\Controllers
 * @author Haze Illias <hazreenaaida@gmail.com>
 */

class OauthController extends BaseController
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function register( Request $request)
    {
        $validator = (new User)->getValidatorRegistration($request->all());

        if ($validator->fails()) {
            return $this->responseJson(true, 201,'Registration failed', $validator->errors()->toArray());
        } else {
            $user = new User();
            $user->fill($request->all());

            if(!$user->save()) {
                return $this->responseJson(true, 201,'Registration failed', $validator->errors()->toArray());
            }

            $data = [
                'name' => $user->getname(),
                'email' => $user->getEmail(),
                'created_at' => $user->getCreatedAt()
            ];
            return $this->responseJson(false, 200,'Registration Successful', $data);
        }
    }

    public function login(Request $request)
    {

        $credentials = request(['email', 'password']);

        if (!Auth::guard('web')->attempt($credentials)) {
            return $this->responseJson(true, 201, 'Unauthorized');
        }

        $user = Auth::guard('web')->user();
        $tokenResult = $user->createToken('user token');
        $tokenResult->token->save();

        if(!$tokenResult->token->save()) {
            Log::error('user token not saved');
        }

        $userData = [
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
        ];

        $data = [
            'token_data' =>   $tokenResult,
            'user_data' => $userData
        ];

        return $this->responseJson(false, 200, 'Login Successful', $data);
    }
}
