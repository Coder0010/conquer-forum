<?php

namespace App\Domains\Auth\Providers;

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
        \App\Domains\Auth\Repositories\Contracts\UserRepository::class => \App\Domains\Auth\Repositories\Eloquent\EloquentUserRepository::class,
        \App\Domains\Auth\Repositories\Contracts\RoleRepository::class => \App\Domains\Auth\Repositories\Eloquent\EloquentRoleRepository::class,
        \App\Domains\Auth\Repositories\Contracts\LeadRepository::class => \App\Domains\Auth\Repositories\Eloquent\EloquentLeadRepository::class,
        /*Your Repos Here 'interface => eloquent class'*/
    ];

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
        /**
         * Bind all repositories to application.
         */
        foreach ($this->repositories as $interface => $eloquent) {
            $this->app->singleton($interface, $eloquent);
        }
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
