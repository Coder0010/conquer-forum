<?php

namespace App\Providers;

use URL;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach (glob(__DIR__.'/../Core/Helpers/*.php') as $filename) {
            require_once $filename;
        }
        Schema::defaultStringLength(191);
        ini_set('memory_limit', '2048M');
        ini_set('upload_max_filesize ', '100M');
        ini_set('post_max_size ', '100M');
        ini_set('max_execution_time', 900);
        set_time_limit(3000);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
