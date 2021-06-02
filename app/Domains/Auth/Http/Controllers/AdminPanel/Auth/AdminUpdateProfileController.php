<?php

namespace App\Domains\Auth\Http\Controllers\AdminPanel\Auth;

use App\Http\Controllers\Controller;
use App\Domains\Auth\Http\Requests\AdminPanel\AdminProfileFormRequest;
use Session;
use Auth;

class AdminUpdateProfileController extends Controller
{
    public $domainAlias = "auths";

    public $nameSpace = "adminpanel";

    public $crudName = "auth";

    public function __construct()
    {
        $this->middleware(["auth","IsAdmin"]);
    }

    public function updateProfileImage()
    {
        $user = Auth::user();
        $user->clearMediaCollection("user-profile");
        $user->addMediaFromRequest("profile")->usingName("image")->toMediaCollection("User-Collection");
        Session::flash("success", __("main.session_updated_message"));
        return redirect()->back();
    }

    public function updateBasicInformation(AdminProfileFormRequest $request)
    {
        $user = Auth::user();
        $user->update($request->all());
        Session::flash("success", __("main.session_updated_message"));
        return redirect()->back();
    }

    public function updatePassword()
    {
        $this->validate(request(), [
            "current_password" => "required",
            "password"         => "min:6|max:28|required_with:password_confirmation|same:password_confirmation",
        ]);
        $hash     = Auth::user()->password;
        $pas      = request("current_password");
        if (password_verify($pas, $hash)) {
            Auth::user()->update(["password" => request("password")]);
            Session::flash("success", "Password Successfully Updated");
        } else {
            Session::flash("danger", "Old Password Is Wrong");
        }
        return redirect()->back();
    }
}
