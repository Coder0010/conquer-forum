<?php

namespace App\Domains\Setting\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to EndUser controller & routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Domains\Setting\Http\Controllers\EndUser';

    /**
     * This namespace is applied to AdminPanel controller & routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $adminNamespace = 'App\Domains\Setting\Http\Controllers\AdminPanel';

    /**
     * This namespace is applied to API controller & routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $apiNamespace = 'App\Domains\Setting\Http\Controllers\API';

    /**
     * This namespace is applied to SAC controller & routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $sacNamespace = 'App\Domains\Setting\Http\Controllers\SAC';

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
        $this->mapSacRoutes();
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
            ->group(app_path('Domains/Setting/Routes/admin.php'));
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
            ->group(app_path('Domains/Setting/Routes/web.php'));
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
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->apiNamespace)
            ->group(app_path("Domains/Setting/Routes/api.php"));
    }

    /**
     * Define the "sac" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapSacRoutes()
    {
        Route::middleware('web')
            ->namespace($this->sacNamespace)
            ->prefix('sac')
            ->group(app_path('Domains/Setting/Routes/sac.php'));
    }
}
