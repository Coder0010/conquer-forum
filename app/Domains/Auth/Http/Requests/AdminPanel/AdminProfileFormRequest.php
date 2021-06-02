<?php

namespace App\Domains\Auth\Http\Requests\AdminPanel;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class AdminProfileFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"   => config("rules.name"),
            "email"  => config("rules.email")."unique:users,email,".Auth::Id(),
            "phone"  => config("rules.phone")."unique:users,phone,".Auth::Id(),
        ];
    }
}
