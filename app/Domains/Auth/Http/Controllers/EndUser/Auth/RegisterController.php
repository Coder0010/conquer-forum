<?php

namespace App\Domains\Auth\Http\Controllers\EndUser\Auth;

use App\Domains\Auth\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Domains\Auth\Providers\RouteServiceProvider;

class RegisterController extends Controller
{
    use RegistersUsers;

    public $redirectTo = RouteServiceProvider::HOME;

    public $domainAlias = "auths";

    public $nameSpace = "enduser";

    public $crudName = "auth";

    public function __construct()
    {
        $this->middleware("guest");
    }

    protected function showRegistrationForm()
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.{$this->crudName}.register", [
            "nameSpace" => $this->nameSpace,
        ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            "name"      => config("rules.name"),
            "username"  => config("rules.username")."|unique:users",
            "email"     => config("rules.email")."|unique:users",
            "password"  => config("rules.password"),
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            "status"    => config("system.status.active"),
            "name"      => $data["name"],
            "username"  => $data["username"],
            "email"     => $data["email"],
            "password"  => $data["password"],
        ]);
        $user->assignRole(config("system.roles.normal.id"));
        return $user;
    }
}
