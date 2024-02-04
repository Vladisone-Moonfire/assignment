<?php

namespace App\Src\Domain\Product\Actions;

use App\Src\Api\Product\Resources\ProductListResource;
use App\Src\Domain\Product\DataTransferObjects\CreateProductDTO;
use App\Src\Domain\Product\Models\Product;

class CreateProductAction
{
    public function __invoke(CreateProductDTO $dto): ProductListResource
    {
        $product = new Product();

        $product->name = $dto->name;
        $product->price = $dto->price;

        $product->saveOrFail();

        return new ProductListResource($product);
    }
}
