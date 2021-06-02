<?php

namespace App\Domains\Auth\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    const HOME = "/";

    /**
     * This namespace is applied to EndUser controller & routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Domains\Auth\Http\Controllers\EndUser';

    /**
     * This namespace is applied to AdminPanel controller & routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $adminNamespace = 'App\Domains\Auth\Http\Controllers\AdminPanel';

    /**
     * This namespace is applied to API controller & routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $apiNamespace = 'App\Domains\Auth\Http\Controllers\API';

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapAdminRoutes();
        $this->mapWebRoutes();
        $this->mapApiRoutes();
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::middleware('web')
            ->namespace($this->adminNamespace)
            ->prefix(config('system.admin.url_prefix'))
            ->as(config('system.admin.url_alias'))
            ->group(app_path('Domains/Auth/Routes/admin.php'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(app_path('Domains/Auth/Routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::middleware('api')
            ->prefix('api')
            ->namespace($this->apiNamespace)
            ->group(app_path("Domains/Auth/Routes/api.php"));
    }
}
