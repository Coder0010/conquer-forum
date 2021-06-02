<?php

namespace App\Domains\Setting\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use App\Core\Abstracts\ServiceProvider;
use App\Domains\Setting\Repositories\Eloquent\EloquentSliderRepository;
use App\Domains\Setting\Repositories\Eloquent\EloquentGalleryRepository;
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
        //
    }
}
