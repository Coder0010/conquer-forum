<?php

namespace App\Http\Controllers;

use App\Core\Abstracts\ResourceController;

class EnduserWebsiteController extends ResourceController
{
    public function redirectToDashboard()
    {
        return redirect()->route("admin.dashboard");
    }

    public function indexPage()
    {
        return view("enduser.pages.home");
    }

    public function changeLang(string $lang)
    {
        if (in_array($lang, AppLanguages())) {
            session()->put("lang", $lang);
        }
        // dd(session('lang'));
        return redirect()->back();
    }
}
