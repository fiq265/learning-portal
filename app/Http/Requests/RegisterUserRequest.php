<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username'  => 'required|string|unique:users,username',
            'name'      => 'required|string',
            'password'  => 'required|string|min:6',
            'role'      => 'required|string'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => [
                'status'   => 422,
                'errors'   => $validator->errors()
            ]
        ]));
    }
}
