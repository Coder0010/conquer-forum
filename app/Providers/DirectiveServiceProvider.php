<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class DirectiveServiceProvider extends ServiceProvider
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
        Blade::if('isActive', function () {
            if (Auth::check()) {
                return Auth::user()->status == config('system.status.active') ? true : false;
            }
            return false;
        });

        foreach (config("system.roles") as $key => $value) {
            Blade::if("{$key}Role", function () use ($value) {
                if (Auth::check()) {
                    return Auth::user()->hasAnyRole($value["name"]) ? true : false;
                }
                return false;
            });
        }

        Blade::directive('printArray', function ($data) {
            return "<?php echo '<br><pre>'; print_r($data); echo '</pre><br>' ?>";
        });
    }
}
