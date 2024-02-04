<?php

namespace App\Src\Api\Product\Requests;

use App\Src\Support\BaseFormRequest;

class CreateProductRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|unique:products,name|required',
            'price' => 'numeric|required',
        ];
    }
}
