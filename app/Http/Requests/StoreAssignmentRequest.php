<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreAssignmentRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'             => 'required|string',
            'description'       => 'required|string',
            'deadline'          => 'required',
            'attachment'        => 'required|mimes:jpg,png,pdf',
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
