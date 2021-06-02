<?php

namespace App\Domains\General\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;

class AdminTypesRequest extends FormRequest
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
                "type_create_name_en"        => config("rules.name_en")."|unique:types,name_en",
                "type_create_name_ar"        => config("rules.name_ar")."|unique:types,name_ar",
                "type_create_description_en" => config("rules.edit_description_en"),
                "type_create_description_ar" => config("rules.edit_description_ar"),
            ];
        } elseif (request()->isMethod("patch")) {
            return [
                "type_edit_name_en"         => config("rules.edit_name_en")."|unique:types,name_en,".request("type"),
                "type_edit_name_ar"         => config("rules.edit_name_ar")."|unique:types,name_ar,".request("type"),
                "type_edit_description_en"  => config("rules.edit_description_en"),
                "type_edit_description_ar"  => config("rules.edit_description_ar"),
            ];
        } elseif (request()->isMethod("delete")) {
            return [

            ];
        }
    }
}
