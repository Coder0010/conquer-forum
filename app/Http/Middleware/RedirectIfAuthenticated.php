<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Core\Services\AdminPanelService;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (auth()->user()->hasAnyRole(AdminPanelService::RolesToAccessingAdminPanel())) {
                    return redirect()->route("admin.dashboard");
                } else {
                    Session::flash("danger", "Middleware [ RedirectIfAuthenticated ] ");
                    return redirect()->route("index");
                }
            }
        }

        return $next($request);
    }
}
