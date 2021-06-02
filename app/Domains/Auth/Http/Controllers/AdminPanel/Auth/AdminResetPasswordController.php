<?php

namespace App\Domains\Auth\Http\Controllers\AdminPanel\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Password;

class AdminResetPasswordController extends Controller
{
    use ResetsPasswords;

    public $domainAlias = "auths";

    public $nameSpace = "adminpanel";

    public $crudName = "auth";

    protected $redirectTo = "/";

    public function __construct()
    {
        $this->middleware("guest");
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request)
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.{$this->crudName}.passwords.reset", [
            "domainAlias" => $this->domainAlias,
            "nameSpace"   => $this->nameSpace,
            "crudName"    => $this->crudName,
            "title"       => __("main.recover_email"),
            "token"       => $request->route()->parameter('token'),
            "email"       => $request->email,
        ]);
    }

    /**
     * Set the user"s password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function setUserPassword($user, $password)
    {
        $user->password = $password;
    }

}
