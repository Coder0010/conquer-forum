<?php

namespace App\Core\Abstracts;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

abstract class ServiceProvider extends LaravelServiceProvider
{
    /**
     * @var string Alias for load Translations and views
     */
    protected $alias;

    /**
     * @var bool Set if will load commands or not
     */
    protected $hasCommands = false;

    /**
     * @var array List of custom Artisan commands
     */
    protected $commands = [];

    /**
     * @var bool Set if will load migrations or not
     */
    protected $hasMigrations = false;

    /**
     * @var bool Set if will load factories or not
     */
    protected $hasFactories = false;

    /**
     * @var array List of model factories to load
     */
    protected $factories = [];

    /**
     * @var bool Set if will load translations or not
     */
    protected $hasTranslations = false;

    /**
     * @var bool Set if will load Views or not
     */
    protected $hasViews = false;

    /**
     * @var bool Set if will load policies or not
     */
    protected $hasPolicies = false;

    /**
     * @var array List of policies to load
     */
    protected $policies = [];

    /**
     * @var array List of providers to load
     */
    protected $providers = [];

    /**
     * Register Domain ServiceProviders.
     */
    public function register()
    {
        collect($this->providers)->each(function ($providerClass) {
            $this->app->register($providerClass);
        });
    }

    /**
     * Boot required registering of views and translations.
     *
     * @throws \ReflectionException
     */
    public function boot()
    {
        $this->registerCommands();
        $this->registerMigrations();
        $this->registerFactories();
        $this->registerTranslations();
        $this->registerViews();
        $this->registerPolicies();
    }

    /**
     * Detects the domain base path so resources can be proper loaded on child classes.
     *
     * @param string $append
     * @return string
     * @throws \ReflectionException
     */
    protected function domainPath($append = null)
    {
        $reflection = new \ReflectionClass($this);

        $realPath = realpath(dirname($reflection->getFileName()) . "/../");

        if (!$append) {
            return $realPath;
        }

        return $realPath . "/" . $append;
    }


    /**
     * Register domain custom Artisan commands.
     */
    protected function registerCommands()
    {
        if ($this->hasCommands && config("domain.commands")) {
            $this->commands($this->commands);
        }
    }

    /**
     * Register domain migrations.
     *
     * @throws \ReflectionException
     */
    protected function registerMigrations()
    {
        if ($this->hasMigrations && config("domain.migrations")) {
            $this->loadMigrationsFrom($this->domainPath("Database/Migrations"));
        }
    }

    /**
     * Register Model Seeds.
     */
    protected function registerSeeds()
    {
        if ($this->hasSeeds && config("domain.seeds")) {
            collect($this->seeds)->each(function ($seederName) {
                (new $seederName())->define();
            });
        }
    }

    /**
     * Register Model Factories.
     */
    protected function registerFactories()
    {
        if ($this->hasFactories && config("domain.factories")) {
            collect($this->factories)->each(function ($factoryName) {
                (new $factoryName())->define();
            });
        }
    }

    /**
     * Register domain translations.
     *
     * @throws \ReflectionException
     */
    protected function registerTranslations()
    {
        if ($this->hasTranslations && config("domain.translations")) {
            $this->loadTranslationsFrom($this->domainPath("Resources/Lang"), $this->alias);
        }
    }

    /**
     * Register domain Views.
     * Use Views by $alias
     * @throws \ReflectionException
     */
    protected function registerViews()
    {
        if ($this->hasViews && config("domain.views")) {
            $this->loadViewsFrom($this->domainPath("Resources/Views"), $this->alias);
        }
    }

    /**
     * Register the application"s policies.
     *
     * @return void
     */
    public function registerPolicies()
    {
        if ($this->hasPolicies && config("domain.policies")) {
            foreach ($this->policies as $key => $value) {
                Gate::policy($key, $value);
            }
        }
    }
}
