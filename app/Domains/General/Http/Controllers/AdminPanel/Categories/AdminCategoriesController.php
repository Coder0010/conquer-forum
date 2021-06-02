<?php

namespace App\Domains\General\Http\Controllers\AdminPanel\Categories;

use Session;
use Exception;
use App\Core\Abstracts\AdminResourceController;
use App\Domains\General\Repositories\Contracts\Categories\CategoryRepository;
use App\Domains\General\Http\Requests\AdminPanel\Categories\AdminCategoriesRequest;

class AdminCategoriesController extends AdminResourceController
{
    /**
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;

        $this->domainAlias = "generals";

        $this->crudName = "categories";

        $this->resourceRequestValidation = AdminCategoriesRequest::class;

        $this->resourcePermissions = [
            "show"    => "Show_Category",
            "create"  => "Create_Category",
            "edit"    => "Edit_Category",
            "delete"  => "Delete_Category",
            "statu"   => "Statu_Category",
        ];

        $this->resourceCreateRequestInputs = [
            "name_en"         => request("category_create_name_en"),
            "name_ar"         => request("category_create_name_ar"),
            "data" => [
                "description_en"  => request("category_create_description_en"),
                "description_ar"  => request("category_create_description_ar"),
            ],
        ];

        $this->resourceEditRequestInputs = [
            "name_en"        => request("category_edit_name_en"),
            "name_ar"        => request("category_edit_name_ar"),
            "data" => [
                "description_en" => request("category_edit_description_en"),
                "description_ar" => request("category_edit_description_ar"),
            ],
        ];
    }
}
