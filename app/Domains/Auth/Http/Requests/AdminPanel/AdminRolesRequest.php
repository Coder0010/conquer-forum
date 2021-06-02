<?php

namespace App\Domains\Auth\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;

class AdminRolesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request()->isMethod("post")) {
            return [
                "role_create_name"        => config("rules.name")."|unique:roles,name",
                "role_create_alias_name"  => config("rules.name"),
                "role_create_permissions" => config("rules.permissions"),
            ];
        }elseif (request()->isMethod("patch")) {
            return [
                "role_edit_alias_name"  => config("rules.edit_name")."|unique:roles,name,".request("role"),
                "role_edit_alias_name"  => config("rules.name"),
                "role_edit_permissions" => config("rules.permissions"),
            ];
        }elseif (request()->isMethod("delete")) {
            return [

            ];
        }
    }
}
