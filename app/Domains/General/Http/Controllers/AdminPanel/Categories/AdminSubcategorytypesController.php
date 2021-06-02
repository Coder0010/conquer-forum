<?php

namespace App\Domains\General\Http\Controllers\AdminPanel\Categories;

use Session;
use Exception;
use App\Core\Abstracts\AdminResourceController;
use App\Domains\General\Repositories\Contracts\Categories\SubcategorytypeRepository;
use App\Domains\General\Http\Requests\AdminPanel\Categories\AdminSubcategorytypesRequest;

class AdminSubcategorytypesController extends AdminResourceController
{
    /**
     * @param SubcategorytypeRepository $repository
     */
    public function __construct(SubcategorytypeRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;

        $this->domainAlias = "generals";

        $this->crudName = "subcategorytypes";

        $this->resourceRequestValidation = AdminSubcategorytypesRequest::class;

        $this->resourcePermissions = [
            "show"    => "Show_Subcategorytype",
            "create"  => "Create_Subcategorytype",
            "edit"    => "Edit_Subcategorytype",
            "delete"  => "Delete_Subcategorytype",
            "statu"   => "Statu_Subcategorytype",
        ];

        $this->resourceCreateRequestInputs = [
            "child_id" => request("subcategorytype_create_subcategory_id"),
            "name_en"  => request("subcategorytype_create_name_en"),
            "name_ar"  => request("subcategorytype_create_name_ar"),
        ];

        $this->resourceEditRequestInputs = [
            "child_id" => request("subcategorytype_edit_subcategory_id"),
            "name_en"  => request("subcategorytype_edit_name_en"),
            "name_ar"  => request("subcategorytype_edit_name_ar"),
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

            $result = $result->searchByMultiName()->searchBySoftDelete()->searchByStatus();

            $category_id = request("subcategorytype_search_category_id");

            if (isset($category_id)) {
                $result = $result->where('parent_id', $category_id);
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
        $edit                        = $this->repository->eloquentFind($id);
        $data["entity"]              = $edit;
        $data["entity"]["parent_id"] = $edit->subcategory->parent_id;
        return $this->adminJsonResponse($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $edit = $this->repository->instance()->whereNull('parent_id')->whereNotNull('child_id')->where('id', $id)->first();
            if ($edit) {
                if (request()->ajax()) {
                    return $this->editAjaxRequest($id);
                }
                return view("adminpanel.pages.domain_action", [
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
        return redirect()->route("{$this->routePerfix}.{$this->crudName}.index");
    }
}
