<?php

namespace App\Src\Domain\Product\Actions;

use App\Src\Api\Product\Resources\ProductListResource;
use App\Src\Domain\Product\DataTransferObjects\UpdateProductDTO;
use App\Src\Domain\Product\Models\Product;
use Illuminate\Http\JsonResponse;

class UpdateProductAction
{
    public function __invoke(UpdateProductDTO $dto, int $id): ProductListResource|JsonResponse
    {
        $product = Product::find($id);

        if(!isset($product)) {
            $json = [
                'status' => false,
                'error' => "Unable to find requested product"
            ];
            return new JsonResponse($json, 404);
        }

        if(isset($dto->name)) {
            $product->name = $dto->name;
        }

        if(isset($dto->price)) {
            $product->price = $dto->price;
        }

        $product->saveOrFail();

        return new ProductListResource($product);
    }
}
