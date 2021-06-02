<?php

namespace App\Http\Middleware;

use App\Core\Services\AdminPanelService;
use Closure;
use Auth;
use Session;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (auth()->user()->hasAnyRole(AdminPanelService::RolesToAccessingAdminPanel())) {
                return $next($request);
            }
        }
        Session::flash("danger", "Middleware [ IsAdmin ] ");
        return redirect()->route("index");
    }
}
