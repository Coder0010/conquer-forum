<?php

namespace App\Domains\Auth\Http\Controllers\AdminPanel;

use Session;
use Exception;
use App\Core\Services\AdminPanelService;
use App\Core\Abstracts\AdminResourceController;
use App\Domains\Auth\Repositories\Contracts\UserRepository;
use App\Domains\Auth\Http\Requests\AdminPanel\AdminUsersRequest;

class AdminUsersController extends AdminResourceController
{
    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;

        $this->domainAlias = "auths";

        $this->crudName = "users";

        $this->resourceRequestValidation = AdminUsersRequest::class;

        $this->resourcePermissions = [
            "show"    => "Show_User",
            "create"  => "Create_User",
            "edit"    => "Edit_User",
            "delete"  => "Delete_User",
            "statu"   => "Statu_User",
        ];

        $this->resourceCreateRequestInputs = [
            "name"               => request("user_create_name"),
            "email"              => request("user_create_email"),
            "phone"              => request("user_create_phone"),
            "password"           => request("user_create_password"),
            "role_id"            => request("user_create_role_id"),
            "email_verified_at"  => now(),
        ];

        $this->resourceEditRequestInputs = [
            "name"     => request("user_edit_name"),
            "email"    => request("user_edit_email"),
            "phone"    => request("user_edit_phone"),
            "role_id"  => request("user_edit_role_id"),
            "password" => request("user_edit_password"),
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

            $email       = request("user_search_email");
            $phone       = request("user_search_phone");
            $role_id     = request("user_search_role_id");
            $provider    = request("user_search_provider");
            $is_verified = request("user_search_is_verified");

            if (isset($email)) {
                $result = $result->where("email", "LIKE", "%$email%");
            }
            if (isset($phone)) {
                $result = $result->where("phone", "LIKE", "%$phone%");
            }
            if (isset($role_id)) {
                $result = $result->whereHas("roles", function ($q) use ($role_id) {
                    return $q->where("roles.id", $role_id);
                });
            }
            if (isset($provider)) {
                $result = $result->whereHas("provider", function ($q) use ($provider) {
                    return $q->where("providers.name", $provider);
                });
            }
            if (isset($is_verified)) {
                if ($is_verified == config("system.answers.yes")) {
                    $result = $result->where("email_verified_at", "<>", null);
                } elseif ($is_verified == config("system.answers.no")) {
                    $result = $result->where("email_verified_at", null);
                }
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

    /**
     * return ajax modal data
     */
    public function editAjaxRequest($id)
    {
        $edit                   = $this->repository->eloquentFind($id);
        $data["entity"]         = $edit;
        $data["entity"]["role"] = $edit->roles->first();
        return $this->adminJsonResponse($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $show = $this->repository->eloquentFind($id);
            if ($show) {
                return view("{$this->domainAlias}::{$this->nameSpace}.{$this->crudName}.show", [
                    "title"         => $show->name,
                    "domainAlias"   => $this->domainAlias,
                    "nameSpace"     => $this->nameSpace,
                    "crudName"      => $this->crudName,
                    "show"          => $show,
                    "orders"        => $show->orders
                ]);
            }
        } catch (Exception $e) {
            Session::flash("danger", $e->getMessage());
        }
        return redirect()->back();
    }
}
