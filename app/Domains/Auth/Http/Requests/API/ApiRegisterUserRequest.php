<?php

namespace App\Domains\Auth\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class ApiRegisterUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "user_name"      => config("rules.name"),
            "user_email"     => config("rules.email")."|unique:users,email",
            "user_phone"     => config("rules.phone")."|unique:users,phone",
            "user_password"  => "required|min:6|required_with:user_password_confirmation|same:user_password_confirmation",
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
