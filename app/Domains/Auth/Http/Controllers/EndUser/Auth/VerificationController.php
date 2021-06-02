<?php

namespace App\Domains\Auth\Http\Controllers\EndUser\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Domains\Auth\Providers\RouteServiceProvider;

class VerificationController extends Controller
{
    use VerifiesEmails;

    public $redirectTo = RouteServiceProvider::HOME;

    public $domainAlias = "auths";

    public $nameSpace = "enduser";

    public $crudName = "auth";

    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware("signed")->only("verify");
        $this->middleware("throttle:6,1")->only("verify", "resend");
    }

    public function show()
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.{$this->crudName}.verify", [
            "nameSpace" => $this->nameSpace,
        ]);
    }
}
