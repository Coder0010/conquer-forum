<?php

namespace App\Domains\Auth\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Domains\General\Repositories\Eloquent\EloquentTypeRepository;
use App\Domains\Item\Repositories\Eloquent\EloquentProductRepository;
use App\Domains\General\Repositories\Eloquent\EloquentBrandRepository;
use App\Domains\General\Repositories\Eloquent\Categories\EloquentCategoryRepository;
use App\Domains\General\Repositories\Eloquent\Categories\EloquentSubcategoryRepository;
use App\Domains\General\Repositories\Eloquent\Categories\EloquentSubcategorytypeRepository;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth", "IsAdmin"]);
    }

    public function index()
    {
        $charts = [

        ];

        $cruds = [

        ];
        return view("adminpanel.pages.domain.group", [
            "title"   => __("main.dashboard"),
            "charts"  => $charts,
            "cruds"   => $cruds,
        ]);
    }
}
