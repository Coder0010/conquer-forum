<?php

namespace App\Domains\Auth\Http\Requests\EndUser;

use Illuminate\Foundation\Http\FormRequest;

class EnduserUpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"      => config("rules.name"),
            "username"  => config("rules.username"),
            "email"     => config("rules.email"),
            "rank"      => config("rules.rank"),
            "password"  => "sometimes|nullable|string|min:8|confirmed",
        ];
    }
}
