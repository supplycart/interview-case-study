<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class CheckToken
{
    public function handle(Request $request, Closure $next): Response{
        try {
            
            $user = JWTAuth::parseToken()->authenticate();

        } catch (\Exception $e) {
            
            if($e instanceof TokenExpiredException)
            {

                $newToken = JWTAuth::parseToken()->refresh();

                return response()->json([ 'status'=> true, 'token'=> $newToken ], 401);
            }
            else if($e instanceof TokenInvalidException)
            {
                return response()->json([ 'status'=> false, 'message'=> 'token invalid' ], 401);

            }
            else {
                return response()->json([ 'status'=> false, 'message'=> 'token not found' ], 401);

            }
        }

        return $next($request);
    }
}
