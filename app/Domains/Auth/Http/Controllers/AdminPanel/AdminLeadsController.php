<?php

namespace App\Domains\Auth\Http\Controllers\AdminPanel;

use Session;
use Exception;
use App\Domains\Auth\Entities\Lead;
use App\Core\Abstracts\AdminResourceController;
use App\Domains\Auth\Repositories\Contracts\LeadRepository;
use App\Domains\Auth\Http\Requests\AdminPanel\AdminLeadsRequest;

class AdminLeadsController extends AdminResourceController
{
    /**
     * @param LeadRepository $repository
     */
    public function __construct(LeadRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;

        $this->domainAlias = "auths";

        $this->crudName = "leads";

        $this->resourceRequestValidation = AdminLeadsRequest::class;

        $this->resourcePermissions = [
            "show"    => "Show_Lead",
            "create"  => "Create_Lead",
            "edit"    => "Edit_Lead",
            "delete"  => "Delete_Lead",
            "statu"   => "Statu_Lead",
        ];

        $this->resourceCreateRequestInputs = [
            "type"         => Lead::ContactType,
            "name"         => request("lead_create_name"),
            "phone"        => request("lead_create_phone"),
            "email"        => request("lead_create_email"),
            "description"  => request("lead_create_description"),
            "country_id"   => request("lead_create_country_id"),
            "city_id"      => request("lead_create_city_id"),
        ];

        $this->resourceEditRequestInputs = [
            "name"         => request("lead_edit_name"),
            "phone"        => request("lead_edit_phone"),
            "email"        => request("lead_edit_email"),
            "description"  => request("lead_edit_description"),
            "country_id"   => request("lead_edit_country_id"),
            "city_id"      => request("lead_edit_city_id"),
        ];
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index()
    {
        try {
            $result = $this->repository->instance()->entityFetchData();

            $result = $result->searchByName()->searchBySoftDelete()->searchByStatus();

            $email       = request("lead_search_email");
            $phone       = request("lead_search_phone");
            $country_id  = request("lead_search_country_id");

            if (isset($email)) {
                $result = $result->where('email', 'LIKE', "%$email%");
            }
            if (isset($phone)) {
                $result = $result->where('phone', 'LIKE', "%$phone%");
            }
            if (isset($country_id)) {
                $result = $result->where('country_id', $country_id);
            }

            $result = $result->ordered()->paginate($this->perPage)->appends(request()->all());

            $data = [
                "title"         => __("main.all"),
                "domainAlias"   => $this->domainAlias,
                "nameSpace"     => $this->nameSpace,
                "crudName"      => $this->crudName,
                "data"          => $result,
            ];
            if (request()->ajax()) {
                return view("{$this->domainAlias}::{$this->nameSpace}.{$this->crudName}.table")->with($data);
            }
            return view("adminpanel.pages.domain.index")->with($data);
        } catch (Exception $e) {
            Session::flash("danger", $e->getMessage());
        }
        return redirect()->route("admin.dashboard");
    }
}
