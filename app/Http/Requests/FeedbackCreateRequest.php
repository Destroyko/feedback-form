<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class FeedbackCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'fullName'          => 'required|string',
            'phoneNumber'     => 'required|string',
            'message'         => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'errors' => $validator->errors(),
                'status' => 'warning'
            ])
        );
    }
}
