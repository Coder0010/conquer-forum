<?php

namespace App\Domains\Auth\Http\Controllers\EndUser\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Domains\Auth\Providers\RouteServiceProvider;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public $redirectTo = RouteServiceProvider::HOME;

    public $domainAlias = "auths";

    public $nameSpace = "enduser";

    public $crudName = "auth";

    public function __construct()
    {
        $this->middleware("guest")->except("logout");
    }

    public function showLoginForm()
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.{$this->crudName}.login", [
            "nameSpace" => $this->nameSpace,
        ]);
    }

}
