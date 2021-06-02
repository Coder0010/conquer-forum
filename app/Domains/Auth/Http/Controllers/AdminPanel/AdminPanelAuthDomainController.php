<?php

namespace App\Domains\Auth\Http\Controllers\AdminPanel;

use App\Core\Abstracts\AdminResourceController;
use App\Domains\Auth\Repositories\Eloquent\EloquentLeadRepository;
use App\Domains\Auth\Repositories\Eloquent\EloquentRoleRepository;
use App\Domains\Auth\Repositories\Eloquent\EloquentUserRepository;

class AdminPanelAuthDomainController extends AdminResourceController
{
    public function __construct()
    {
        $this->domainAlias = "auths";

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
                    "name" => "{$this->domainAlias}::{$this->nameSpace}.leads.table",
                    "data"  => [
                        "data" => (new EloquentLeadRepository)->eloquentData(),
                    ]
                ],
                "modals" => [
                    "name" => [
                        "{$this->domainAlias}::{$this->nameSpace}.leads._modal._create_modal",
                        "{$this->domainAlias}::{$this->nameSpace}.leads._modal._edit_modal",
                    ],
                    "data" => [
                        "domainAlias" => $this->domainAlias,
                        "nameSpace"   => $this->nameSpace,
                        "crudName"    => "leads",
                    ]
                ],
            ], //leads
            [
                "status" => true,
                "table" => [
                    "name" => "{$this->domainAlias}::{$this->nameSpace}.roles.table",
                    "data"  => [
                        "data" => (new EloquentRoleRepository)->eloquentData()
                    ]
                ],
                "modals" => [
                    "name" => [
                        "{$this->domainAlias}::{$this->nameSpace}.roles._modal._create_modal",
                        "{$this->domainAlias}::{$this->nameSpace}.roles._modal._edit_modal",
                    ],
                    "data" => [
                        "domainAlias" => $this->domainAlias,
                        "nameSpace"   => $this->nameSpace,
                        "crudName"    => "roles",
                    ]
                ],
            ], //roles
            [
                "status" => true,
                "table" => [
                    "name" => "{$this->domainAlias}::{$this->nameSpace}.users.table",
                    "data"  => [
                        "data" => (new EloquentUserRepository)->eloquentData()
                    ]
                ],
                "modals" => [
                    "name" => [
                        "{$this->domainAlias}::{$this->nameSpace}.users._modal._create_modal",
                        "{$this->domainAlias}::{$this->nameSpace}.users._modal._edit_modal",
                    ],
                    "data" => [
                        "domainAlias" => $this->domainAlias,
                        "nameSpace"   => $this->nameSpace,
                        "crudName"    => "users",
                    ]
                ],
            ], //users
        ];
        return view("adminpanel.pages.domain.group", [
            "title"   => __("main.auths"),
            "charts"  => $charts,
            "cruds"   => $cruds,
        ]);
    }
}
