<?php

namespace App\Domains\General\Http\Controllers\AdminPanel;

use Session;
use Exception;
use App\Core\Abstracts\AdminResourceController;
use App\Domains\General\Repositories\Contracts\BrandRepository;
use App\Domains\General\Http\Requests\AdminPanel\AdminBrandsRequest;

class AdminBrandsController extends AdminResourceController
{
    /**
     * @param BrandRepository; $repository
     */
    public function __construct(BrandRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;

        $this->domainAlias = "generals";

        $this->crudName = "brands";

        $this->resourceRequestValidation = AdminBrandsRequest::class;

        $this->resourcePermissions = [
            "show"    => "Show_Brand",
            "create"  => "Create_Brand",
            "edit"    => "Edit_Brand",
            "delete"  => "Delete_Brand",
            "statu"   => "Statu_Brand",
        ];

        $this->resourceCreateRequestInputs = [
            "name_en"        => request("brand_create_name_en"),
            "name_ar"        => request("brand_create_name_ar"),
            "data" => [
                "description_en" => request("brand_create_description_en"),
                "description_ar" => request("brand_create_description_ar"),
            ],
        ];

        $this->resourceEditRequestInputs = [
            "name_en"        => request("brand_edit_name_en"),
            "name_ar"        => request("brand_edit_name_ar"),
            "data" => [
                "description_en" => request("brand_edit_description_en"),
                "description_ar" => request("brand_edit_description_ar"),
            ]
        ];
    }
}
