<?php

namespace App\Domains\General\Http\Controllers\AdminPanel\Categories;

use Session;
use Exception;
use App\Core\Abstracts\AdminResourceController;
use App\Domains\General\Repositories\Contracts\Categories\SubcategoryRepository;
use App\Domains\General\Http\Requests\AdminPanel\Categories\AdminSubcategoriesRequest;

class AdminSubcategoriesController extends AdminResourceController
{
    /**
     * @param SubcategoryRepository $repository
     */
    public function __construct(SubcategoryRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;

        $this->domainAlias = "generals";

        $this->crudName = "subcategories";

        $this->resourceRequestValidation = AdminSubcategoriesRequest::class;

        $this->resourcePermissions = [
            "show"    => "Show_Subcategory",
            "create"  => "Create_Subcategory",
            "edit"    => "Edit_Subcategory",
            "delete"  => "Delete_Subcategory",
            "statu"   => "Statu_Subcategory",
        ];

        $this->resourceCreateRequestInputs = [
            "parent_id" => request("subcategory_create_category_id"),
            "name_en"   => request("subcategory_create_name_en"),
            "name_ar"   => request("subcategory_create_name_ar"),
        ];

        $this->resourceEditRequestInputs = [
            "parent_id" => request("subcategory_edit_category_id"),
            "name_en"   => request("subcategory_edit_name_en"),
            "name_ar"   => request("subcategory_edit_name_ar"),
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

            $category_id = request("subcategory_search_category_id");

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $edit = $this->repository->instance()->whereNotNull('parent_id')->whereNull('child_id')->where('id', $id)->first();
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
