<?php

namespace App\Domains\General\Http\Requests\AdminPanel\Categories;

use Illuminate\Foundation\Http\FormRequest;

class AdminSubcategoriesRequest extends FormRequest
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
            "subcategory_create_category_id" => config("rules.category_id"),
            "subcategory_create_name_en"     => config("rules.name_en")."|unique:categories,name_en",
            "subcategory_create_name_ar"     => config("rules.name_ar")."|unique:categories,name_ar",
            ];
        }elseif (request()->isMethod("patch")) {
            return [
            "subcategory_edit_category_id" => config("rules.category_id"),
            "subcategory_edit_name_en"     => config("rules.edit_name_en")."|unique:categories,name_en,".request("subcategory"),
            "subcategory_edit_name_ar"     => config("rules.edit_name_ar")."|unique:categories,name_ar,".request("subcategory"),
            ];
        }elseif (request()->isMethod("patch")) {
            return [

            ];
        }
    }
}
