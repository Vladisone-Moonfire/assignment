<?php

namespace App\Src\Support;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class BaseFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator): void
    {
        $json = [
            'status' => false,
            'error' => $validator->errors()->first()
        ];
        $response = new JsonResponse($json, 422);
        throw (new ValidationException($validator, $response))->status(422);
    }
}
