<?php

namespace App\Core\Services;

use DB;
use Auth;
use Session;
use Spatie\Permission\Models\Role;
use App\Domains\Auth\Entities\User;
use Illuminate\Support\Facades\Gate;

class AdminPanelService
{
    public static function AccountNoPermissionOrRole($permissions, $roles)
    {
        if ($permissions && $roles) {
            return "Your Account Doesn't Have Permission [ $permissions ] OR Role [ $roles ] ";
        } elseif ($permissions) {
            return "Your Account Doesn't Have Permission [ $permissions ] ";
        } elseif ($roles) {
            return "Your Account Doesn't Have Roles [ $roles ] ";
        }
    }

    public static function AccountNoPermission($message)
    {
        return "Your Account Doesn't Have Permission [ $message ] ";
    }

    public static function AccountDeactived()
    {
        return "Your Account Has Been Deactivated";
    }

    public static function RolesGroupedBy($name)
    {
        $roles = Role::whereGuardType($name)->get();
        foreach ($roles as $one_role) {
            $result[] = $one_role->name;
        }
        return @$result;
    }

    public static function RolesToAccessingAdminPanel()
    {
        $group_one = ["Super_Role", "Manager_Role", "Sub_Manager_Role"];
        $group_two = self::RolesGroupedBy("Admin_Guard") ?? [];
        return array_merge($group_one, $group_two);
    }

    public static function CheckPermissionOrRole($permissions = null, $roles = null)
    {
        if ($permissions && $roles) {
            if (auth()->user()->hasAnyRole([$roles]) || auth()->user()->hasAnyPermission(explode("||", $permissions))) {
                return true;
            }
            Session::flash("warning", self::AccountNoPermissionOrRole($permissions, $roles));
        }
        if ($permissions) {
            if (auth()->user()->hasAnyPermission(explode("||", $permissions))) {
                return true;
            }
            Session::flash("warning", self::AccountNoPermission($permissions));
        }
        if ($roles) {
            if (auth()->user()->hasAnyRole([$roles])) {
                return true;
            }
            Session::flash("warning", self::AccountNoPermission($roles));
        }
        return false;
    }
}
