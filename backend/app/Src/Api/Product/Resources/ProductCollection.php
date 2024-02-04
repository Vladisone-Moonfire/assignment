<?php

namespace App\Src\Api\Product\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public $collects = ProductListResource::class;
}
