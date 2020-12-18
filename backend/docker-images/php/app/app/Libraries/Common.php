<?php
/**
 *
 * @Project: interview-case-study
 * @Filename: Common.php
 * @Author: longnc <nguyenchilong90@gmail.com>
 * @Created Date: 12/16/20 7:53 PM
 *
 * @Description: Text description here
 */

namespace App\Libraries;

use App\Models\User;
use Firebase\JWT\JWT;
use App\Models\Activity;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;

class Common
{
	
	/**
	 * @param mixed $data Result data response
	 * @param integer $code HTTP Code response
	 * @param array $options Options for other data response to Client
	 * @return array
	 */
	public static function formatResponse($data, int $code = 200, array $options = array()): array {
		$response = [
			'statusCode' => $code,
			'data'       => $data
		];
		$response = !empty($options) ? $response['options'] = $options : $response;
		return $response;
	}
	
	/**
	 * Create JWT for any auth from client call request to server
	 * @param User $user
	 * @return array
	 */
	public static function createJWT(User $user): array
	{
		$now = time();
		$expired = self::getJWTExpired() + $now;
		$payload = [
			'iss'  => env('JWT_ISS'),
			'sub'  => $user->id,
			'name' => $user->name,
			'iat'  => $now,
			'exp'  => $expired
		];
		return [
			'type'      => 'Bearer',
			'token'     => JWT::encode($payload, env('JWT_SECRET')),
			'expiredAt' => $expired
		];
	}
	
	/**
	 * Parser JWT Token from client before do any action
	 * @param string $token
	 * @return array|string[]
	 */
	public static function verifyJWT(string $token): array
	{
		if(empty($token)) return ['error' => 'Token string is required'];
		try {
			$decoded = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
			return json_decode(json_encode($decoded), true);
		} catch (ExpiredException $exception) {
			return ['error' => 'Provided JWT Token is expired'];
		} catch (\Exception $exception) {
			return ['error' => $exception->getMessage()];
		}
	}
	
	/**
	 * Get expire time for JWT Token
	 * @param int $numberHour
	 * @return float|int
	 */
	public static function getJWTExpired(int $numberHour = 0)
	{
		$numberHour = empty($numberHour) ? env('JWT_EXPIRE') : $numberHour;
		return ($numberHour * 60 * 60);
	}
	
	/**
	 * write activity log on each income request
	 * @param Request $request
	 * @return mixed
	 */
	public static function logActivities(Request $request)
	{
		$userInfo = $request->authUser;
		return Activity::create([
			'user_id' => (!empty($userInfo) ? $userInfo->id : 0),
			'input'   => json_encode(!empty($request->all()) ? $request->all() : (!empty($request->post()) ? $request->post() : $request->query())),
			'route'   => $request->getRequestUri(),
			'options' => json_encode([
				'ip' => $request->getClientIps(),
				'method' => $request->getMethod(),
				'port' => $request->getPort(),
				'scheme' => $request->getSchemeAndHttpHost()
			]),
			'headers' => json_encode($request->server->getHeaders())
		]);
	}
}
