<?php

namespace App\Domains\General\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use App\Core\Abstracts\ServiceProvider;
use App\Domains\General\Repositories\Eloquent\EloquentTypeRepository;
use App\Domains\General\Repositories\Eloquent\EloquentBrandRepository;
use App\Domains\General\Repositories\Eloquent\Categories\EloquentCategoryRepository;

class ComponentsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer([
            "items::adminpanel.products._form.*", "items::adminpanel.products.table"
        ], function ($view) {
            $view->with([
                "brands" => (new EloquentBrandRepository)->eloquentAll()->ordered()->active()->get(),
                "types"  => (new EloquentTypeRepository)->eloquentAll()->ordered()->active()->get()
            ]);
        });

        View::composer([
            "generals::adminpanel.subcategories._form.*", "generals::adminpanel.subcategories.table",
            "generals::adminpanel.subcategorytypes._form.*", "generals::adminpanel.subcategorytypes.table",
            "items::adminpanel.products._form.*", "items::adminpanel.products.table",
            "settings::adminpanel.galleries._form.*", "settings::adminpanel.galleries.table",
        ], function ($view) {
            $view->with([
                "categories" => (new EloquentCategoryRepository)->eloquentAll()->ordered()->active()->get()
            ]);
        });
    }
}
