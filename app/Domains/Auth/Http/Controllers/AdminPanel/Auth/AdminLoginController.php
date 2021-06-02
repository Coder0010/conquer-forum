<?php

namespace App\Domains\Auth\Http\Controllers\AdminPanel\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    public $domainAlias = "auths";

    public $nameSpace = "adminpanel";

    public $crudName = "auth";

    public function __construct()
    {
        $this->middleware("guest")->except("logout");
    }

    public function showLoginForm()
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.{$this->crudName}.login", [
            "domainAlias" => $this->domainAlias,
            "nameSpace"   => $this->nameSpace,
            "crudName"    => $this->crudName,
            "title"       => __("main.login"),
        ]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            "email"    => "required|email",
            "password" => "required|min:6",
        ]);
        if (Auth::guard("web")->attempt(["email" => $request->email, "password" => $request->password], $request->remember)) {
            return redirect()->route("admin.dashboard");
        }
        return redirect()->back()->withErrors(["password" => "Password Is Wrong"])->withInput($request->only("email", "remember"));
    }

    public function logout()
    {
        $this->guard()->logout();
        return redirect("/admin/login");
    }
}
