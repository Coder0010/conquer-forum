<?php

namespace App\Domains\Auth\Http\Controllers\AdminPanel\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;
use Auth;

class AdminForgetPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public $domainAlias = "auths";

    public $nameSpace = "adminpanel";

    public $crudName = "auth";

    public function __construct()
    {
        $this->middleware("guest");
    }

    public function showLinkRequestForm()
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.{$this->crudName}.passwords.forget", [
            "domainAlias" => $this->domainAlias,
            "nameSpace"   => $this->nameSpace,
            "crudName"    => $this->crudName,
            "title"       => __("main.recover_email"),
        ]);
    }
}
