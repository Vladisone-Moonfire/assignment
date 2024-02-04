<?php

namespace App\Src\Domain\Product\Actions;

use App\Src\Api\Product\Resources\ProductListResource;
use App\Src\Domain\Product\Models\Product;
use Illuminate\Http\JsonResponse;

class ViewProductAction
{
    public function __invoke(int $id): ProductListResource|JsonResponse
    {
        $product = Product::find($id);

        if(!isset($product)) {
            $json = [
                'status' => false,
                'error' => "Unable to find requested product"
            ];
            return new JsonResponse($json, 404);
        }

        return new ProductListResource($product);
    }
}
