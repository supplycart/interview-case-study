<?php

namespace App\Http\Middleware;

use Closure;
use App\Libraries\Common;
use Illuminate\Contracts\Auth\Factory as Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
	        $response = Common::formatResponse([
	        	'message' => 'Unauthorized'
	        ], Response::HTTP_UNAUTHORIZED);
        	return response()->json($response);
        }
        return $next($request);
    }
}
