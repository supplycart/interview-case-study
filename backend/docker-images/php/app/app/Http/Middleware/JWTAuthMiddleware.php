<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Libraries\Common;
use Symfony\Component\HttpFoundation\Response;

class JWTAuthMiddleware
{
	/**
	 * Handle an incoming request.
	 * @param \Illuminate\Http\Request  $request
	 * @param Closure $next
	 * @param string|null $guard
	 * @return \Illuminate\Http\JsonResponse|mixed
	 */
    public function handle($request, Closure $next, $guard = null)
    {
	    $token = $request->bearerToken();
	    if(empty($token)) {
		    $response = Common::formatResponse([
			    'status'  => 'UNAUTHORIZED',
			    'message' => 'Token string is required'
		    ], Response::HTTP_UNAUTHORIZED);
		    return response()->json($response);
	    }
	    $credentials = Common::verifyJWT($token);
	    if(!empty($credentials['error'])) {
		    $response = Common::formatResponse([
			    'status'  => 'BAD_REQUEST',
			    'message' => $credentials['error']
		    ], Response::HTTP_BAD_REQUEST);
		    return response()->json($response);
	    }
	    // verify token and next action
	    $request->authUser = User::find($credentials['sub']);
        return $next($request);
    }
}
