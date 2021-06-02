<?php

namespace App\Domains\Auth\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;

class AdminUsersRequest extends FormRequest
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
                "user_create_role_id"   => config("rules.role_id"),
                "user_create_name"      => config("rules.name"),
                "user_create_email"     => config("rules.email")."|unique:users,email",
                "user_create_phone"     => config("rules.phone")."|unique:users,phone",
                "user_create_password"  => "required|min:6|required_with:user_create_password_confirmation|same:user_create_password_confirmation",
            ];
        }elseif (request()->isMethod("patch")) {
            return [
                "user_edit_role_id"   => config("rules.role_id"),
                "user_edit_name"      => config("rules.name"),
                "user_edit_email"     => config("rules.email")."|unique:users,email,".request("user"),
                "user_edit_phone"     => config("rules.phone")."|unique:users,phone,".request("user"),
                "user_edit_password"  => "nullable|sometimes|required_with:user_edit_password_confirmation|same:user_edit_password_confirmation",
            ];
        }elseif (request()->isMethod("delete")) {
            return [

            ];
        }
    }
}
