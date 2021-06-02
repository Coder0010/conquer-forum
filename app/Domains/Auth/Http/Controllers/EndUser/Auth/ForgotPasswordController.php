<?php

namespace App\Domains\Auth\Http\Controllers\EndUser\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Domains\Auth\Providers\RouteServiceProvider;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public $redirectTo = RouteServiceProvider::HOME;

    public $domainAlias = "auths";

    public $nameSpace = "enduser";

    public $crudName = "auth";

    public function __construct()
    {
        $this->middleware("guest")->except("logout");
    }

    public function showLinkRequestForm ()
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.{$this->crudName}.passwords.email", [
            "nameSpace" => $this->nameSpace,
        ]);
    }

}
