<?php

namespace App\Domains\Auth\Http\Requests\EndUser;

use Illuminate\Foundation\Http\FormRequest;

class EnduserLeadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "g-recaptcha-response" => config("rules.g_recaptcha_response"),
            "lead_subject"         => config("rules.name"),
            "lead_description"     => config("rules.edit_description"),
        ];
    }
}
