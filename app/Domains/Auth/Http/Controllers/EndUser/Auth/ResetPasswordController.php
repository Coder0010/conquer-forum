<?php

namespace App\Domains\Auth\Http\Controllers\EndUser\Auth;

use Str;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Domains\Auth\Providers\RouteServiceProvider;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    public $redirectTo = RouteServiceProvider::HOME;

    public $domainAlias = "auths";

    public $nameSpace = "enduser";

    public $crudName = "auth";

    public function __construct()
    {
        $this->middleware("guest")->except("logout");
    }

    public function showResetForm ()
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.{$this->crudName}.passwords.reset", [
            "nameSpace" => $this->nameSpace,
        ]);
    }

    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            "password"       => $password,
            "remember_token" => Str::random(60),
        ])->save();

        $this->guard()->login($user);
    }

}
