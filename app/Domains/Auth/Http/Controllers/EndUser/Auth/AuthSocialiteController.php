<?php

namespace App\Domains\Auth\Http\Controllers\EndUser\Auth;

use URL;
use Auth;
use Socialite;
use Illuminate\Http\Request;
use App\Domains\Auth\Entities\User;
use App\Http\Controllers\Controller;
use App\Domains\Auth\Entities\Provider;

class AuthSocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider, Request $request)
    {
        if (! $request->input("code")) {
            return redirect("/")->withErrors("Login_Failed: ".$request->input("error")." - ".$request->input("error_reason"));
        }
        $user = Socialite::driver($provider)->user();
        if ($user->getEmail()) {
            $selectprovider = Provider::whereName($provider)->whereProviderId($user->getId())->first();
            if (!$selectprovider) {
                $getUserOrCreate = User::whereEmail($user->getEmail())->first();
                if (!$getUserOrCreate) {
                    $getUserOrCreate = User::create([
                        "name"   => $user->getName(),
                        "email"  => $user->getEmail(),
                        "status" => config("system.status.active"),
                    ]);
                    $getUserOrCreate->assignRole(config("system.roles.normal.id"));
                }
                Provider::create([
                    "name"        => $provider,
                    "provider_id" => $user->getId(),
                    "user_id"     => $getUserOrCreate->id,
                    "avater"      => $user->getAvatar(),
                ]);
            } else {
                $getUserOrCreate = User::findOrFail($selectprovider->user_id);
            }
            Auth::login($getUserOrCreate);
        }
        return redirect("/");
    }
}
