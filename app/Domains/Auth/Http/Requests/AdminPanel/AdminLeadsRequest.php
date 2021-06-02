<?php

namespace App\Domains\Auth\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;

class AdminLeadsRequest extends FormRequest
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
                "lead_create_name"        => config("rules.name"),
                "lead_create_email"       => config("rules.email"),
                "lead_create_phone"       => config("rules.phone"),
                "lead_create_description" => config("rules.edit_description"),
            ];
        }elseif (request()->isMethod("patch")) {
            return [
                "lead_edit_name"        => config("rules.name"),
                "lead_edit_email"       => config("rules.email"),
                "lead_edit_phone"       => config("rules.edit_phone"),
                "lead_edit_description" => config("rules.edit_description"),
            ];
        }elseif (request()->isMethod("delete")) {
            return [

            ];
        }
    }
}
