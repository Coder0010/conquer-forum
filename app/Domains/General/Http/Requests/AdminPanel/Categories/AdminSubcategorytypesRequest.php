<?php

namespace App\Domains\General\Http\Requests\AdminPanel\Categories;

use Illuminate\Foundation\Http\FormRequest;

class AdminSubcategorytypesRequest extends FormRequest
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
                "subcategorytype_create_category_id"    => config('rules.category_id'),
                "subcategorytype_create_subcategory_id" => config('rules.subcategory_id'),
                "subcategorytype_create_name_en"        => config("rules.name_en")."|unique:categories,name_en",
                "subcategorytype_create_name_ar"        => config("rules.name_ar")."|unique:categories,name_ar",
            ];
        }elseif (request()->isMethod("patch")) {
            return [
                "subcategorytype_edit_category_id"    => config('rules.category_id'),
                "subcategorytype_edit_subcategory_id" => config('rules.subcategory_id'),
                "subcategorytype_edit_name_en"        => config("rules.edit_name_en")."|unique:categories,name_en,".request("subcategorytype"),
                "subcategorytype_edit_name_ar"        => config("rules.edit_name_ar")."|unique:categories,name_ar,".request("subcategorytype"),
            ];
        }elseif (request()->isMethod("delete")) {
            return [

            ];
        }
    }
}
