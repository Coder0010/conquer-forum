<?php

namespace App\Domains\General\Providers;

use App\Core\Abstracts\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Alias for load Translations and views.
     *
     * @var string
     */
    protected $alias = 'generals';

    /**
     * Set if will load commands or not.
     *
     * @var bool
     */
    protected $hasCommands = true;

    /**
     * List of custom Artisan commands.
     *
     * @var array
     */
    protected $commands = [];

    /**
     * Set if will load migrations or not.
     *
     * @var bool
     */
    protected $hasMigrations = true;

    /**
     * Set if will load factories or not.
     *
     * @var bool
     */
    protected $hasFactories = true;

    /**
     * List of model factories to load.
     *
     * @var array
     */
    protected $factories = [];

    /**
     * Set if will load translations or not.
     *
     * @var bool
     */
    protected $hasTranslations = true;

    /**
     * Set if will load Views or not.
     *
     * @var bool
     */
    protected $hasViews = true;

    /**
     * Set if will load policies or not.
     *
     * @var bool
     */
    protected $hasPolicies = true;

    /**
     * List of policies to load.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * List of providers to load.
     *
     * @var array
     */
    protected $providers = [
        ComponentsServiceProvider::class,
        RouteServiceProvider::class,
        RepositoryServiceProvider::class,
    ];
}
