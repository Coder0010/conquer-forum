<?php

namespace App\Domains\General\Http\Controllers\AdminPanel;

use Session;
use Exception;
use App\Core\Abstracts\AdminResourceController;
use App\Domains\General\Repositories\Contracts\TypeRepository;
use App\Domains\General\Http\Requests\AdminPanel\AdminTypesRequest;

class AdminTypesController extends AdminResourceController
{
    /**
     * @param TypeRepository $repository
     */
    public function __construct(TypeRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;

        $this->domainAlias = "generals";

        $this->crudName = "types";

        $this->resourceRequestValidation = AdminTypesRequest::class;

        $this->resourcePermissions = [
            "show"    => "Show_Type",
            "create"  => "Create_Type",
            "edit"    => "Edit_Type",
            "delete"  => "Delete_Type",
            "statu"   => "Statu_Type",
        ];

        $this->resourceCreateRequestInputs = [
            "name_en"         => request("type_create_name_en"),
            "name_ar"         => request("type_create_name_ar"),
            "data" => [
                "description_en"  => request("type_create_description_en"),
                "description_ar"  => request("type_create_description_ar"),
            ],
        ];

        $this->resourceEditRequestInputs = [
            "name_en"        => request("type_edit_name_en"),
            "name_ar"        => request("type_edit_name_ar"),
            "data" => [
                "description_en" => request("type_edit_description_en"),
                "description_ar" => request("type_edit_description_ar"),
            ],
        ];
    }
}
