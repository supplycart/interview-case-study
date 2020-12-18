<?php
/**
 *
 * @Project: interview-case-study
 * @Filename: AuthController.php
 * @Author: longnc <nguyenchilong90@gmail.com>
 * @Created Date: 12/16/20 6:42 PM
 *
 * @Description: Text description here
 */

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\VerifyEmail;
use App\Libraries\Common;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
	public function __construct(Request $request){
		parent::__construct($request);
	}
	
	/**
	 * Verify email address
	 * @param Request $request
	 * @param string $token
	 * @return \Illuminate\View\View|\Laravel\Lumen\Application
	 */
	public function verifyEmail(Request $request, string $token)
	{
		$verify = Common::verifyJWT($token);
		if(empty($verify)) {
			$data = [
				'title' => 'Error Verify',
				'message' => 'Error verify email or token expired!'
			];
		} else {
			$data = [
				'title' => 'Success Verify',
				'message' => 'Email address verified successfully.'
			];
		}
		$user = User::find($verify['sub']);
		$user->verified_at = date('Y-m-d H:i:s');
		$user->save();
		return view('verified_email', $data);
	}
	
	/**
	 * Register account in system
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function createUser(Request $request): JsonResponse
	{
		$validator = Validator::make($request->all(), [
			'name'             => 'required|min:2|max:255',
			'email'            => 'required|email:rfc',
			'password'         => 'required|min:6',
			'password_confirm' => 'same:password'
		]);
		
		if ($validator->fails()) {
			$response = Common::formatResponse($validator->errors(), Response::HTTP_BAD_REQUEST);
			return response()->json($response);
		}
		// check exist email address
		$hasEmail = User::where('email', $request->input('email'))->first();
		if(empty($hasEmail)) {
			// create user when valid
			$user = new User();
			$user->name = $request->input('name');
			$user->email = $request->input('email');
			$user->password = Hash::make($request->input('password'));
			$user->status = 'ACTIVE';
			$user->save();
			// send email to verify email address
			try {
				$verifyToken = Common::createJWT($user);
				$verifyLink = route('verify-email', ['token' => $verifyToken['token']]);
				Mail::to($request->input('email'))
					->send(new VerifyEmail([
						'name' => $request->input('name'),
						'subject' => 'Verify Email Address',
						'verifyLink' => $verifyLink,
						'helpText' => 'Token will expire in 8 hours'
					]));
				$response = Common::formatResponse([
					'message'  => 'Registered Successfully, please check email to verify',
					'userInfo' => array_merge($verifyToken, [
						'userId' => $user->id,
						'name'   => $user->name,
						'email'  => $user->email
					])
				]);
				return response()->json($response);
			} catch (\Exception $exception) {
				Log::debug($exception->getMessage());
				$response = Common::formatResponse(['message' => 'Registered fail, please try again']);
				return response()->json($response);
			}
		}
		Log::debug('Exists email address, please change other email and try again');
		$response = Common::formatResponse([
			'message' => 'Exists email address, please change other email and try again'
		], Response::HTTP_NOT_ACCEPTABLE);
		return response()->json($response);
	}
	
	/**
	 * Login account into system
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function postLogin(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email'    => 'required|email:rfc',
			'password' => 'required|min:6',
		]);
		if ($validator->fails()) {
			$response = Common::formatResponse($validator->errors(), Response::HTTP_BAD_REQUEST);
			return response()->json($response);
		}
		$user = User::select('id', 'name', 'email', 'password', 'status')
			->where('email', $request->input('email'))
			->first();
		// check email has in db
		if(empty($user)) {
			$response = Common::formatResponse([
				'message' => 'The account not in system, please register or check email address'
			], Response::HTTP_UNAUTHORIZED);
			return response()->json($response);
		}
		// check status active
		if($user->status !== 'ACTIVE') {
			$response = Common::formatResponse([
				'message' => 'The account not active for now, please check again with admin'
			], Response::HTTP_UNAUTHORIZED);
			return response()->json($response);
		}
		// check password correct
		if(Hash::check($request->input('password'), $user->password)){
			$token = Common::createJWT($user);
			$response = Common::formatResponse(array_merge($token, [
				'userId' => $user->id,
				'name'   => $user->name,
				'email'  => $user->email
			]));
			return response()->json($response);
		}
		$response = Common::formatResponse([
			'message' => 'Email/Username & Password have problem, please check again then try it'
		], Response::HTTP_BAD_REQUEST);
		return response()->json($response);
	}
	
	/**
	 * Remove user object for logout
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function postLogout(Request $request)
	{
		$user = $request->authUser;
		if(!empty($user)) {
			$request->except(['authUser', 'Authorization']);
			$message = 'Logout successfully';
		} else {
			$message = 'Logout failure';
		}
		$response = Common::formatResponse([
			'message'     => $message,
			'redirectUrl' => env('APP_HOME')
		]);
		return response()->json($response);
	}
}
