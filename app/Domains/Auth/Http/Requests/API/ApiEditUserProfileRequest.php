<?php

namespace App\Domains\Auth\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class ApiEditUserProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "user_edit_name"  => config("rules.name")."|unique:users,name,".request()->user()->id,
            "user_edit_email" => config("rules.email")."|unique:users,email,".request()->user()->id,
            "user_edit_phone" => "required|regex:/[0-9]{10}/|digits:11|unique:users,phone,".request()->user()->id,
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
