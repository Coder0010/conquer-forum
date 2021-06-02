<?php

namespace App\Domains\Auth\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class ApiLeadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "lead_name"        => config("rules.name"),
            "lead_description" => config("rules.description"),
            // "lead_email"       => config("rules.email"),
            // "lead_phone"       => config("rules.phone"),
        ];
    }
    
    /**
     * custom validation error response.
     *
     * @return validator Instance
     */
    protected function failedValidation(Validator $validator)
    {
        $response = response([
            "payload" => ["message" => __("main.session_failed_validation_message")],
            "errors"  => $validator->errors()
        ], 422);
        throw new ValidationException($validator, $response);
    }
}
