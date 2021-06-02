<?php

namespace App\Domains\General\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;

class AdminBrandsRequest extends FormRequest
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
                "brand_create_name_en"        => config("rules.name_en")."|unique:brands,name_en",
                "brand_create_name_ar"        => config("rules.name_ar")."|unique:brands,name_ar",
                "brand_create_description_en" => config("rules.description_en"),
                "brand_create_description_ar" => config("rules.description_ar"),
                "brand_create_image"          => config("rules.edit_image"),
            ];
        } elseif (request()->isMethod("patch")) {
            return [
                "brand_edit_name_en"        => config("rules.edit_name_en")."|unique:brands,name_en,".request("brand"),
                "brand_edit_name_ar"        => config("rules.edit_name_ar")."|unique:brands,name_ar,".request("brand"),
                "brand_edit_description_en" => config("rules.edit_description_en"),
                "brand_edit_description_ar" => config("rules.edit_description_ar"),
                "brand_edit_image"          => config("rules.edit_image"),
            ];
        } elseif (request()->isMethod("delete")) {
            return [

            ];
        }
    }
}
