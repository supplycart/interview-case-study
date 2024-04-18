<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Admin;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authorization = $request->header('Authorization');
        
        $admin = Admin::where(["session_id" => $authorization])->first();

        if($admin){
            return $next($request);
        }else {
            return response()->json(["error_message" => "Page Not Found", "error_code" => "PAGE_NOT_FOUND"], 401);
        }
    }
}
