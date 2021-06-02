<?php

namespace App\Domains\Auth\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class ApiAddToFavoriteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "entity_id" => "required|required_with:entity_type",
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
