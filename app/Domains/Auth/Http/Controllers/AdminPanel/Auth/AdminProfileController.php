<?php

namespace App\Domains\Auth\Http\Controllers\AdminPanel\Auth;

use App\Http\Controllers\Controller;
use Auth;

class AdminProfileController extends Controller
{
    public $domainAlias = "auths";

    public $nameSpace = "adminpanel";

    public $crudName = "auth";

    public function __construct()
    {
        $this->middleware(["auth","IsAdmin"]);
    }

    public function profile()
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.{$this->crudName}.profile", [
            "domainAlias" => $this->domainAlias,
            "nameSpace"   => $this->nameSpace,
            "crudName"    => $this->crudName,
            "title"       => __("main.profile"),
        ]);
    }

    public function unreadedNotifications()
    {
        return Auth::user()->unreadNotifications;
    }

    public function allNotifications()
    {
        return Auth::user()->notifications;
    }

    public function readNotification()
    {
        Auth::user()->unreadNotifications()->find(request("id"))->markAsRead();
        return response()->json(["statu" => "success", "message" => "Notificaiton Readed Successfully" ], 200);
    }
}
