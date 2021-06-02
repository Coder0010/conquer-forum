<?php

namespace App\Core\Abstracts;

use DB;
use Session;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class AdminResourceController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Domain Alias.
     * @var string
     */
    protected $domainAlias;

    /**
     * @var string
     */
    protected $nameSpace = "adminpanel";

    /**
     * Crud Type & Route Perfix.
     * @var string
     */
    protected $routePerfix = "admin";

    /**
     * View Path.
     * @var string
     */
    protected $crudName;

    /**
     * @var string
     */
    protected $repository;

    /**
     * @var string
     */
    protected $resourceRoles = "Super_Role||Manager_Role";

    /**
     * @var string
     */
    protected $resourcePermissions = [
        "show"    => "",
        "create"  => "",
        "edit"    => "",
        "delete"  => "",
        "statu"   => "",
    ];

    /**
     * @var string
     */
    protected $resourceCreateRequestInputs;

    /**
     * @var ResourceEditRequestInputs
     */
    protected $resourceEditRequestInputs;

    protected $perPage;

    public function __construct()
    {
        $this->middleware("role_or_permission:Super_Role|Manager_Role|".$this->resourcePermissions["show"])->only("index");
        $this->middleware("role_or_permission:Super_Role|Manager_Role|".$this->resourcePermissions["create"])->only("create", "store");
        $this->middleware("role_or_permission:Super_Role|Manager_Role|".$this->resourcePermissions["edit"])->only("edit", "update", "statu");
        $this->middleware("role_or_permission:Super_Role|Manager_Role|".$this->resourcePermissions["delete"])->only("delete", "destroy", "multiDelete");
        $this->perPage = request("perPage") ?? 0;
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index()
    {
        try {
            $result = $this->repository->instance()->entityFetchData();

            $result = $result->searchByMultiName()->searchBySoftDelete()->searchByStatus();

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
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $show = $this->repository->eloquentFind($id);
            if ($show) {
                return view("{$this->domainAlias}::{$this->nameSpace}.{$this->crudName}.show", [
                    "title"         => __("main.show"),
                    "domainAlias"   => $this->domainAlias,
                    "nameSpace"     => $this->nameSpace,
                    "crudName"      => $this->crudName,
                    "show"          => $show,
                ]);
            }
        } catch (Exception $e) {
            Session::flash("danger", $e->getMessage());
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view("adminpanel.pages.domain.action", [
                "title"         => __("main.create"),
                "domainAlias"   => $this->domainAlias,
                "nameSpace"     => $this->nameSpace,
                "crudName"      => $this->crudName,
                "actionForm"    => "_create_form",
            ]);
        } catch (Exception $e) {
            Session::flash("danger", $e->getMessage());
        }
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $validation = new $this->resourceRequestValidation;
        $this->validate(request(), $validation->rules());
        DB::beginTransaction();
        try {
            $store = $this->repository->eloquentCreate($this->resourceCreateRequestInputs);
            if ($store) {
                Session::flash("success", " [ ". (!is_array($store->name) && $store->name ? $store->name : $store->name_val) ." ] " . __("main.session_created_message"));
            } else {
                Session::flash("danger", __("main.session_falid_created_message"));
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Session::flash("danger", $e->getMessage());
        }
        return redirect()->back();
    }

    /**
     * return ajax modal data
     */
    public function editAjaxRequest($id)
    {
        $edit                          = $this->repository->eloquentFind($id);
        $data["entity"]                = $edit;
        $data["entity"]["image"]       = GetImageUrlFromStorage($edit, "{$edit->getEntityClassName()}-Collection");
        $data["entity"]["other_media"] = $edit->getMedia("Multi-{$edit->getEntityClassName()}-Collection");
        return $this->adminJsonResponse($data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $edit = $this->repository->eloquentFind($id);
            if ($edit) {
                if (request()->ajax()) {
                    return $this->editAjaxRequest($id);
                }
                return view("adminpanel.pages.domain.action", [
                    "title"         => __("main.edit"),
                    "domainAlias"   => $this->domainAlias,
                    "nameSpace"     => $this->nameSpace,
                    "crudName"      => $this->crudName,
                    "actionForm"    => "_edit_form",
                    "edit"          => $edit,
                ]);
            }
        } catch (Exception $e) {
            Session::flash("danger", $e->getMessage());
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $resourceValidation = new $this->resourceRequestValidation;
        $this->validate(request(), $resourceValidation->rules());
        DB::beginTransaction();
        try {
            $update = $this->repository->eloquentUpdate($id, $this->resourceEditRequestInputs);
            Session::flash("success", " [ ". (!is_array($update->name) && $update->name ? $update->name : $update->name_val) ." ] " . __("main.session_updated_message"));
            DB::commit();
        } catch (Exception $e) {
            Session::flash("danger", $e->getMessage());
            DB::rollback();
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id)
    {
        DB::beginTransaction();
        try {
            $delete = $this->repository->eloquentDelete($id);
            if ($delete) {
                Session::flash("success", __("main.session_deleted_message"));
            } else {
                Session::flash("danger", __("main.session_falid_deleted_message"));
            }
            DB::commit();
        } catch (Exception $e) {
            Session::flash("danger", $e->getMessage());
            DB::rollback();
        }
        return redirect()->back();
    }

    /**
     * restore the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(int $id)
    {
        DB::beginTransaction();
        try {
            $restore = $this->repository->eloquentRestore($id);
            if ($restore) {
                Session::flash("success", __("main.session_restored_message"));
            } else {
                Session::flash("danger", __("main.session_falid_restored_message"));
            }
            DB::commit();
        } catch (Exception $e) {
            Session::flash("danger", $e->getMessage());
            DB::rollback();
        }
        return redirect()->back();
    }

    /**
     * destroy the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        DB::beginTransaction();
        try {
            $destroy = $this->repository->eloquentDestroy($id);
            if ($destroy) {
                Session::flash("success", __("main.session_destroy_message"));
            } else {
                Session::flash("danger", __("main.session_falid_destroy_message"));
            }
            DB::commit();
        } catch (Exception $e) {
            Session::flash("danger", $e->getMessage());
            DB::rollback();
        }
        return redirect()->back();
    }

    /**
     * changeStatus Of Entitiy.
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(int $id)
    {
        if (request()->ajax()) {
            DB::beginTransaction();
            try {
                $data = $this->repository->eloquentChangeStatus($id);
                DB::commit();
                return $this->adminJsonResponse($data);
            } catch (Exception $e) {
                DB::rollback();
                return $this->adminJsonResponse($e->getMessage());
            }
            return $this->adminJsonResponse("CheckPermissionOrRole");
        }
        return redirect()->route("{$this->routePerfix}.{$this->crudName}.index");
    }

    /**
     * multiRestore Of Entitiy.
     * @return \Illuminate\Http\Response
     */
    public function multiRestore(Request $request)
    {
        $validatedData = $request->validate([
            "ids" => "required|array",
        ]);
        DB::beginTransaction();
        try {
            $ids = request("ids");

            foreach ($ids as $row) {
                $this->repository->eloquentRestore($row);
            }
            Session::flash("success", __("main.session_restored_message"));
            DB::commit();
        } catch (Exception $e) {
            Session::flash("danger", $e->getMessage());
            DB::rollback();
        }
        return redirect()->back();
    }

    /**
     * multiDelete Of Entitiy.
     * @return \Illuminate\Http\Response
     */
    public function multiDelete(Request $request)
    {
        $validatedData = $request->validate([
            "ids" => "required|array",
        ]);
        DB::beginTransaction();
        try {
            $ids = request("ids");
            $delete = $this->repository->eloquentDelete($ids);

            if ($delete) {
                Session::flash("success", __("main.session_deleted_message"));
            } else {
                Session::flash("danger", __("main.session_falid_deleted_message"));
            }
            DB::commit();
        } catch (Exception $e) {
            Session::flash("danger", $e->getMessage());
            DB::rollback();
        }
        return redirect()->back();
    }

    /**
     * multiOrder Of Entitiy.
     * @return \Illuminate\Http\Response
     */
    public function multiOrder(Request $request)
    {
        $validatedData = $request->validate([
            "order"   => "required|array",
        ]);
        DB::beginTransaction();
        try {
            $all_data = $this->repository->eloquentAll()->get();

            $data_after_update = [];
            foreach ($all_data as $entity) {
                foreach ($request->order as $order) {
                    if ($order["id"] == $entity->id) {
                        $entity->update(["order" => $order["position"]]);
                        $data_after_update[] = ["id" => $entity->id, "position" =>  $order["position"]];
                    }
                }
            }
            return $this->adminJsonResponse([
                "data" => $all_data,
                "data_after_update" => $data_after_update
            ]);
            DB::commit();
        } catch (Exception $e) {
            Session::flash("danger", $e->getMessage());
            DB::rollback();
        }
        return redirect()->back();
    }

    /**
     * Handeling adminJsonResponse.
     * @param  mixed   $data
     * @param  integer $statusCode
     * @return JsonResponse
     */
    public function adminJsonResponse($data, int $statusCode = 200) : JsonResponse
    {
        return response()->json([
            "payload" => $data,
        ], $statusCode);
    }
}
