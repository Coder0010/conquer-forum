<?php

namespace App\Domains\Setting\Http\Controllers\AdminPanel;

use App\Core\Abstracts\AdminResourceController;
use App\Domains\Setting\Repositories\Eloquent\EloquentBlogRepository;
use App\Domains\Setting\Repositories\Eloquent\EloquentPageRepository;
use App\Domains\Setting\Repositories\Eloquent\EloquentSliderRepository;
use App\Domains\Setting\Repositories\Eloquent\EloquentGalleryRepository;

class AdminPanelSettingDomainController extends AdminResourceController
{
    public function __construct()
    {
        $this->domainAlias = "settings";

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
                    "name" => "{$this->domainAlias}::{$this->nameSpace}.sliders.table",
                    "data"  => [
                        "data" => (new EloquentSliderRepository)->eloquentData(),
                    ]
                ],
                "modals" => [
                    "name" => [
                        "{$this->domainAlias}::{$this->nameSpace}.sliders._modal._create_modal",
                        "{$this->domainAlias}::{$this->nameSpace}.sliders._modal._edit_modal",
                    ],
                    "data" => [
                        "domainAlias" => $this->domainAlias,
                        "nameSpace"   => $this->nameSpace,
                        "crudName"    => "sliders",
                    ]
                ],
            ], //sliders
            [
                "status" => true,
                "table" => [
                    "name" => "{$this->domainAlias}::{$this->nameSpace}.blogs.table",
                    "data"  => [
                        "data" => (new EloquentBlogRepository)->eloquentData(),
                    ]
                ],
                "modals" => [
                    "name" => [
                        "{$this->domainAlias}::{$this->nameSpace}.blogs._modal._create_modal",
                        "{$this->domainAlias}::{$this->nameSpace}.blogs._modal._edit_modal",
                    ],
                    "data" => [
                        "domainAlias" => $this->domainAlias,
                        "nameSpace"   => $this->nameSpace,
                        "crudName"    => "blogs",
                    ]
                ],
            ], //blogs
            [
                "status" => true,
                "table" => [
                    "name" => "{$this->domainAlias}::{$this->nameSpace}.pages.table",
                    "data"  => [
                        "data" => (new EloquentPageRepository)->eloquentData(),
                    ]
                ],
                "modals" => [
                    "name" => [
                        "{$this->domainAlias}::{$this->nameSpace}.pages._modal._create_modal",
                        "{$this->domainAlias}::{$this->nameSpace}.pages._modal._edit_modal",
                    ],
                    "data" => [
                        "domainAlias" => $this->domainAlias,
                        "nameSpace"   => $this->nameSpace,
                        "crudName"    => "pages",
                    ]
                ],
            ], //pages
            [
                "status" => true,
                "table" => [
                    "name" => "{$this->domainAlias}::{$this->nameSpace}.galleries.table",
                    "data"  => [
                        "data" => (new EloquentGalleryRepository)->eloquentData(),
                    ]
                ],
                "modals" => [
                    "name" => [
                        "{$this->domainAlias}::{$this->nameSpace}.galleries._modal._create_modal",
                        "{$this->domainAlias}::{$this->nameSpace}.galleries._modal._edit_modal",
                    ],
                    "data" => [
                        "domainAlias" => $this->domainAlias,
                        "nameSpace"   => $this->nameSpace,
                        "crudName"    => "galleries",
                    ]
                ],
            ], //galleries
        ];
        return view("adminpanel.pages.domain.group", [
            "title"   => __("main.settings"),
            "charts"  => $charts,
            "cruds"   => $cruds,
        ]);
    }
}
