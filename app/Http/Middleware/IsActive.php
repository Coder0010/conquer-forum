<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Session;
use App\Core\Services\AdminPanelService;

class IsActive
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->status == config("system.status.active")) {
                return $next($request);
            }
        }
        Session::flash("warning", AdminPanelService::AccountDeactived());
        return redirect()->route("admin.dashboard");
    }
}
