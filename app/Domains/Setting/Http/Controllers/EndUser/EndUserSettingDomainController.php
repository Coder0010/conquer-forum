<?php

namespace App\Domains\Setting\Http\Controllers\EndUser;

use DB;
use Session;
use Exception;
use App\Domains\Setting\Entities\Blog;
use App\Domains\Setting\Entities\Gallery;
use App\Core\Abstracts\ResourceController;

class EndUserSettingDomainController extends ResourceController
{
    protected $domainAlias = "settings";

    protected $nameSpace = "enduser";

    public function aboutUs()
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.about_us", [
            "title" => GetSettingTransByKey("navbar_trans_about_us"),
        ]);
    }

    public function contactUs()
    {
        return view("{$this->domainAlias}::{$this->nameSpace}.contact_us", [
            "title" => GetSettingTransByKey("navbar_trans_contact_us"),
        ]);
    }

}
