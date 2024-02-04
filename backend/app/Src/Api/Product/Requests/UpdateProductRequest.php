<?php

namespace App\Src\Api\Product\Requests;

use App\Src\Support\BaseFormRequest;

class UpdateProductRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|unique:products,name',
            'price' => 'numeric',
        ];
    }
}
