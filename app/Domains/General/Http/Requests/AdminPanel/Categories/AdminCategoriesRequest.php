<?php

namespace App\Domains\General\Http\Requests\AdminPanel\Categories;

use Illuminate\Foundation\Http\FormRequest;

class AdminCategoriesRequest extends FormRequest
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
                "category_create_name_en"        => config("rules.name_en")."|unique:categories,name_en",
                "category_create_name_ar"        => config("rules.name_ar")."|unique:categories,name_ar",
                "category_create_description_en" => config("rules.edit_description_en"),
                "category_create_description_ar" => config("rules.edit_description_ar"),
            ];
        }elseif (request()->isMethod("patch")) {
            return [
                "category_edit_name_en"         => config("rules.edit_name_en")."|unique:categories,name_en,".request("category"),
                "category_edit_name_ar"         => config("rules.edit_name_ar")."|unique:categories,name_ar,".request("category"),
                "category_edit_description_en"  => config("rules.edit_description_en"),
                "category_edit_description_ar"  => config("rules.edit_description_ar"),
            ];
        }elseif (request()->isMethod("delete")) {
            return [

            ];
        }
    }
}
