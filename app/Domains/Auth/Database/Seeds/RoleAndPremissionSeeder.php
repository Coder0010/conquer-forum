<?php

namespace App\Domains\Auth\Database\Seeds;

use Artisan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPremissionSeeder extends Seeder
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Artisan::call("permission:cache-reset");
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('role_has_permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('model_has_roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach (config('system.roles') as $role) {
            Role::create($role);
        }

        foreach (config('system.ungrouped_modules') as $module) {
            Permission::create([ 'name' => $module, 'status' => config('system.status.active'), 'model_name' => 'AD_Ungrouped_Modules', 'guard_name' => 'web' ]);
        }

        foreach (config('system.grouped_modules') as $module) {
            foreach (config('system.permission_prefix') as $prefix) {
                Permission::create([ 'name' => $prefix.'_'.$module, 'status' => config('system.status.active'), 'model_name' => "AD_{$module}", 'guard_name' => 'web' ]);
            }
        }

        $super_role_permissions = Permission::all();

        $manager_role_permissions = Permission::whereStatus(config('system.status.active'))
                                            ->where('name', 'not like', '%Category%')
        ->get();

        $admin_role_permissions = Permission::whereStatus(config('system.status.active'))
                                        ->where('model_name', 'not like', '%AD_Ungrouped_Modules%')
                                        ->where('name', 'not like', '%Role%')
                                        ->where('name', 'not like', '%Category%')
        ->get();

        Role::findById(config('system.roles.super.id'))->givePermissionTo($super_role_permissions);
        Role::findById(config('system.roles.manager.id'))->givePermissionTo($manager_role_permissions);
        Role::findById(config('system.roles.admin.id'))->givePermissionTo($admin_role_permissions);

        $model_roles = [
            ['model_id' => 1, 'model_type' => 'App\Domains\Auth\Entities\User', 'role_id' => config('system.roles.super.id')],
            ['model_id' => 2, 'model_type' => 'App\Domains\Auth\Entities\User', 'role_id' => config('system.roles.manager.id')],
            ['model_id' => 4, 'model_type' => 'App\Domains\Auth\Entities\User', 'role_id' => config('system.roles.admin.id')],
            ['model_id' => 5, 'model_type' => 'App\Domains\Auth\Entities\User', 'role_id' => config('system.roles.normal.id')],
        ];
        foreach ($model_roles as $item) {
            DB::table('model_has_roles')->insert($item);
        }
    }
}
