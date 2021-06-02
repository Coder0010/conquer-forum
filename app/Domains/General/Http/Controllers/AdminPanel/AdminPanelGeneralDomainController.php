<?php

namespace App\Domains\General\Http\Controllers\AdminPanel;

use App\Core\Abstracts\AdminResourceController;
use App\Domains\General\Repositories\Eloquent\EloquentTypeRepository;
use App\Domains\General\Repositories\Eloquent\EloquentBrandRepository;
use App\Domains\General\Repositories\Eloquent\Categories\EloquentCategoryRepository;
use App\Domains\General\Repositories\Eloquent\Categories\EloquentSubcategoryRepository;
use App\Domains\General\Repositories\Eloquent\Categories\EloquentSubcategorytypeRepository;

class AdminPanelGeneralDomainController extends AdminResourceController
{
    public function __construct()
    {
        $this->domainAlias = "generals";

        $this->nameSpace = "adminpanel";
    }

    public function index()
    {
        $charts = [

        ];

        $cruds = [
            [
                "status" => true,
                "table" => [
                    "name" => "{$this->domainAlias}::{$this->nameSpace}.brands.table",
                    "data"  => [
                        "data" => (new EloquentBrandRepository)->eloquentData(),
                    ]
                ],
                "modals" => [
                    "name" => [
                        "{$this->domainAlias}::{$this->nameSpace}.brands._modal._create_modal",
                        "{$this->domainAlias}::{$this->nameSpace}.brands._modal._edit_modal",
                    ],
                    "data" => [
                        "domainAlias"   => $this->domainAlias,
                        "nameSpace"     => $this->nameSpace,
                        "crudName" => "brands",
                    ]
                ],
            ], //brands
            [
                "status" => true,
                "table" => [
                    "name" => "{$this->domainAlias}::{$this->nameSpace}.types.table",
                    "data"  => [
                        "data" => (new EloquentTypeRepository)->eloquentData(),
                    ]
                ],
                "modals" => [
                    "name" => [
                        "{$this->domainAlias}::{$this->nameSpace}.types._modal._create_modal",
                        "{$this->domainAlias}::{$this->nameSpace}.types._modal._edit_modal",
                    ],
                    "data" => [
                        "domainAlias"   => $this->domainAlias,
                        "nameSpace"     => $this->nameSpace,
                        "crudName" => "types",
                    ]
                ],
            ], //types
            [
                "status" => true,
                "table" => [
                    "name" => "{$this->domainAlias}::{$this->nameSpace}.categories.table",
                    "data"  => [
                        "data" => (new EloquentCategoryRepository)->eloquentData(),
                    ]
                ],
                "modals" => [
                    "name" => [
                        "{$this->domainAlias}::{$this->nameSpace}.categories._modal._create_modal",
                        "{$this->domainAlias}::{$this->nameSpace}.categories._modal._edit_modal",
                    ],
                    "data" => [
                        "domainAlias"   => $this->domainAlias,
                        "nameSpace"     => $this->nameSpace,
                        "crudName" => "categories",
                    ]
                ],
            ], //categories
            [
                "status" => true,
                "table" => [
                    "name" => "{$this->domainAlias}::{$this->nameSpace}.subcategories.table",
                    "data"  => [
                        "data" => (new EloquentSubcategoryRepository)->eloquentData(),
                    ]
                ],
                "modals" => [
                    "name" => [
                        "{$this->domainAlias}::{$this->nameSpace}.subcategories._modal._create_modal",
                        "{$this->domainAlias}::{$this->nameSpace}.subcategories._modal._edit_modal",
                    ],
                    "data" => [
                        "domainAlias"   => $this->domainAlias,
                        "nameSpace"     => $this->nameSpace,
                        "crudName" => "subcategories",
                    ]
                ],
            ], //subcategories
            [
                "status" => true,
                "table" => [
                    "name" => "{$this->domainAlias}::{$this->nameSpace}.subcategorytypes.table",
                    "data"  => [
                        "data" => (new EloquentSubcategorytypeRepository)->eloquentData(),
                    ]
                ],
                "modals" => [
                    "name" => [
                        "{$this->domainAlias}::{$this->nameSpace}.subcategorytypes._modal._create_modal",
                        "{$this->domainAlias}::{$this->nameSpace}.subcategorytypes._modal._edit_modal",
                    ],
                    "data" => [
                        "domainAlias"   => $this->domainAlias,
                        "nameSpace"     => $this->nameSpace,
                        "crudName" => "subcategorytypes",
                    ]
                ],
            ], //subcategorytypes
        ];
        return view("adminpanel.pages.domain.group", [
            "title"   => __("main.generals"),
            "charts"  => $charts,
            "cruds"   => $cruds,
        ]);
    }
}
