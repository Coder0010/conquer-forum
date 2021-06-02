<?php

namespace App\Domains\General\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Repositories Array With Interface as a Key and Eloquent as a Value.
     *
     * @var array
     */
    private $repositories = [
        \App\Domains\General\Repositories\Contracts\Categories\CategoryRepository::class => \App\Domains\General\Repositories\Eloquent\Categories\EloquentCategoryRepository::class,
        \App\Domains\General\Repositories\Contracts\Categories\SubcategoryRepository::class => \App\Domains\General\Repositories\Eloquent\Categories\EloquentSubcategoryRepository::class,
        \App\Domains\General\Repositories\Contracts\Categories\SubcategorytypeRepository::class => \App\Domains\General\Repositories\Eloquent\Categories\EloquentSubcategorytypeRepository::class,
        \App\Domains\General\Repositories\Contracts\BrandRepository::class => \App\Domains\General\Repositories\Eloquent\EloquentBrandRepository::class,
        \App\Domains\General\Repositories\Contracts\TypeRepository::class => \App\Domains\General\Repositories\Eloquent\EloquentTypeRepository::class,
        /*Your Repos Here 'interface => eloquent class'*/
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Bind all repositories to application.
         */
        foreach ($this->repositories as $interface => $eloquent) {
            $this->app->singleton($interface, $eloquent);
        }
    }

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
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array_keys($this->repositories);
    }
}
