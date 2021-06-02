<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsNormal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (auth()->user()->hasAnyRole(config("system.roles.normal.id"))) {
                return $next($request);
            }
        }
        return response()->json([
            "payload" => [
                "message" => __("main.session_you_have_no_permission_to_access_this_url--NormalUserOnly--"),
            ],
        ], 422);
    }
}
