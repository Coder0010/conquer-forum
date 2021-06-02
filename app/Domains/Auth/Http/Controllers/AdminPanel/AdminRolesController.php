<?php

namespace App\Domains\Auth\Http\Controllers\AdminPanel;

use Session;
use Exception;
use App\Core\Abstracts\AdminResourceController;
use App\Domains\Auth\Repositories\Contracts\RoleRepository;
use App\Domains\Auth\Http\Requests\AdminPanel\AdminRolesRequest;

class AdminRolesController extends AdminResourceController
{
    /**
     * @param RoleRepository $repository
     */
    public function __construct(RoleRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;

        $this->domainAlias = "auths";

        $this->crudName = "roles";

        $this->resourceRequestValidation = AdminRolesRequest::class;

        $this->resourcePermissions = [
            "show"    => "Show_Role",
            "create"  => "Create_Role",
            "edit"    => "Edit_Role",
            "delete"  => "Delete_Role",
            "statu"   => "Statu_Role",
        ];

        $this->resourceCreateRequestInputs = [
            "name"        => request("role_create_name"),
            "alias_name"  => request("role_create_alias_name"),
            "permissions" => request("role_create_permissions"),
        ];
        $this->resourceEditRequestInputs = [
            "alias_name"  => request("role_edit_alias_name"),
            "permissions" => request("role_edit_permissions"),
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

            // $result = $result->searchByName()->searchByStatus();

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

    /**
     * return ajax modal data
     */
    public function editAjaxRequest($id)
    {
        $edit                          = $this->repository->eloquentFind($id);
        $data["entity"]                = $edit;
        $data["entity"]["permissions"] = $edit->permissions()->allRelatedIds();
        return $this->adminJsonResponse($data);
    }
}
