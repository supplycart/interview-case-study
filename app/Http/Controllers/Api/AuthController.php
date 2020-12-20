<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Mail\RegistrationVerification;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Validator;

class AuthController extends Controller
{
    protected $otp_expired = 2;
    protected $jwt_key;


    public function __construct()
    {
        // We set the guard api as default driver
        $this->jwt_key     = env("APP_KEY");
        $this->otp_expired = env("OTP_EXPIRY", 3);
    }

    //register api
    public function register(RegisterRequest $request)
    {
        $input             = $request->customer();
        $input['password'] = bcrypt($input['password']);
        $user              = User::create($input);
        $success['token']  = $user->createToken('Personal Access Token')->accessToken;
        $success['user']   = $user;
//        $mail              = new RegistrationVerification($user);
//        Mail::send($mail);

        $user->sendEmailVerificationNotification();

        return response()->json(
            [
                "status"  => true,
                "data"    => $success,
                "message" => "Register is success",
            ]
        );
    }

    //Login api
    public function login(LoginRequest $request)
    {
        sleep(5);
        $credential = $request->credentials();
        if (auth()->attempt($credential)) {
            $user             = auth()->user();
            $token            = $user->createToken('LoginToken');
            $success['token'] = $token->accessToken;
            $success['token'] = $token->plainTextToken;
            $success['user']  = $user;
//            if (isset($credential["email"]) && !$user->email_verified_at) {
//                return response()->json(
//                    [
//                        "status"  => false,
//                        'message' => 'Please verify your email address first or login using your mobile phone',
//                    ],
//                    200
//                );
//            }
//            activity()->withProperties(['user_agent' => $request->header('User-Agent')])->log('login');

            return response()->json(
                [
                    "status"  => true,
                    "data"    => $success,
                    "token"   => $token->plainTextToken,
                    "message" => "Login success",
                ],
                200
            );
        } else {
            return response()->json(
                [
                    "status"  => false,
                    'message' => 'Invalid password or username',
                ],
                400
            );
        }
    }

    // user detail api
    public function user()
    {
        $user = Auth::user();

        return response()->json(["status" => true, 'data' => $user, "message" => "Data retrieved"], 200);
    }


    // forgot password API
    public function forgotPassword(Request $request)
    {
        $customer = Customer::where("email", $request->email)->first();
        if ($customer) {
            $mail = new RegistrationVerification($customer);
            Mail::send($mail);
        }

        return response()->json(["status" => true, "message" => "If your account exist your email will be sent"], 200);
    }

    //logout API
    public function logout()
    {
        // Get user who requested the logout
        $user = request()->user();
        // Revoke current user token
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return response()->json(["status" => true, 'data' => [], "message" => "successfully logout"]);
    }


    //for test purpose only
    public function redirectToProvider($provider)
    {
//        dd(Socialite::driver($provider)->stateless()->redirect());

        return Socialite::driver($provider)->redirect();
    }


    //activate/verify code/link from the verification email after the registration
    public function activate(Request $request)
    {
        DB::beginTransaction();
        try {
            $token   = $request->token;
            $decoded = JWT::decode($token, $this->jwt_key, array('HS256'));
            if ($decoded->exp > time()) {
                $customer = Customer::findOrFail($decoded->id);
                if ($customer->email_verified_at) {
                    return response()->json(
                        [
                            "status"  => false,
                            "code"    => 422,
                            "data"    => null,
                            "message" => "Your email is already verified",
                        ],
                        200
                    );
                }
                if ($customer->email == $request->email) {
                    $customer->email_verified_at = date('Y-m-d H:i:s');
                    $customer->save();
                }

                DB::commit();

                return response()->json(
                    [
                        "status"  => true,
                        "code"    => 200,
                        "data"    => null,
                        "message" => "Email verification is successfully",
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        "status"  => false,
                        "code"    => 422,
                        "data"    => null,
                        "message" => "Invalid or expired token.",
                    ],
                    200
                );
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(
                [
                    "status"  => false,
                    "data"    => $e->getMessage(),
                    "error"   => $e->getLine(),
                    "message" => "Invalid or expired token",
                ],
                200
            );
        }
    }
}
