<?php

namespace App\Domains\Auth\Http\Controllers\EndUser;

use DB;
use Session;
use Exception;
use App\Domains\Auth\Entities\Lead;
use App\Core\Abstracts\ResourceController;
use App\Domains\Auth\Http\Requests\EndUser\EnduserLeadRequest;

class EndUserAuthDomainController extends ResourceController
{
    protected $domainAlias = "auths";

    protected $nameSpace = "enduser";

    public function leadsSend(EnduserLeadRequest $request)
    {
        DB::beginTransaction();
        try {
            Lead::create([
                "status"      => config("system.status.active"),
                "type"        => Lead::ContactType,
                "name"        => request("lead_name"),
                "description" => request("lead_description"),
                "phone"       => request("lead_phone"),
                "email"       => request("lead_email"),
                "subject"     => request("lead_subject"),
            ]);
            DB::commit();
            Session::flash("success", __("main.session_created_message"));
        } catch (Exception $e) {
            DB::rollback();
            Session::flash("danger", $e->getMessage());
        }
        return redirect()->back();
    }
}
