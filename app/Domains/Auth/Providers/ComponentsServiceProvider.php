<?php

namespace App\Domains\Auth\Providers;

use Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use App\Core\Abstracts\ServiceProvider;
use Spatie\Permission\Models\Permission;
use App\Domains\Auth\Repositories\Eloquent\EloquentRoleRepository;

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
            "auths::adminpanel.roles._form.*"
        ], function ($view) {
            $permissions = Permission::query();
            if (auth()->user()->hasRole(config("system.roles.super.id"))) {
                $permissions = $permissions->get()->groupBy("model_name");
            } elseif (auth()->user()->hasRole(config("system.roles.manager.id"))) {
                $permissions = $permissions->whereStatus(config("system.status.active"))->get()->groupBy("model_name");
            }
            $view->with([
                "permissions" => $permissions
            ]);
        });

        View::composer([
            "auths::adminpanel.users._form.*", "auths::adminpanel.users.table",
        ], function ($view) {
            $roles = Role::select("*", "name as name_en");
            if (Auth::user()->hasRole(config("system.roles.super.id"))) {
                $roles = $roles->where("guard_type", "<>", "Super_Guard");
            } elseif (Auth::user()->hasRole(config("system.roles.manager.id"))) {
                $roles = $roles->where("guard_type", "<>", "Super_Guard")->where("guard_type", "<>", "Manager_Guard");
            } elseif (Auth::user()->hasRole(config("system.roles.sub_manager.id"))) {
                $roles = $roles->where("guard_type", "<>", "Super_Guard")->where("guard_type", "<>", "Manager_Guard")->where("guard_type", "<>", "Sub_Manager_Guard");
            } elseif (Auth::user()->hasAnyRole(AdminPanelService::RolesGroupedBy("Admin_Guard"))) {
                $roles = $roles->where("guard_type", "Normal_Guard");
            }
            $view->with([
                "roles" => $roles->latest()->get()
            ]);
        });
    }
}
