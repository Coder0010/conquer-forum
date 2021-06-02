<?php

namespace App\Http\Middleware;

use Closure;

class SetLocaleLanguage
{
    public function handle($request, Closure $next)
    {
        if ($request->headers->has("Accept-Language") && in_array($request->header("Accept-Language"), AppLanguages())) {
            app()->setLocale($request->header("Accept-Language"));
        } elseif (session()->has("lang") && in_array(session()->get("lang"), AppLanguages())) {
            app()->setLocale(session()->get("lang"));
        } else {
            session()->put("lang", GetDefaultLang());
            app()->setLocale(GetDefaultLang());
        }
        return $next($request);
    }
}
