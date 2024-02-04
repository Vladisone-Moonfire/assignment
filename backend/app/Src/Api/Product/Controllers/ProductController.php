<?php

namespace App\Src\Api\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Src\Api\Product\Requests\CreateProductRequest;
use App\Src\Api\Product\Requests\UpdateProductRequest;
use App\Src\Api\Product\Resources\ProductCollection;
use App\Src\Api\Product\Resources\ProductListResource;
use App\Src\Domain\Product\Actions\CreateProductAction;
use App\Src\Domain\Product\Actions\DeleteProductAction;
use App\Src\Domain\Product\Actions\UpdateProductAction;
use App\Src\Domain\Product\Actions\ViewProductAction;
use App\Src\Domain\Product\DataTransferObjects\CreateProductDTO;
use App\Src\Domain\Product\DataTransferObjects\UpdateProductDTO;
use App\Src\Domain\Product\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    public function index(Request $request): ProductCollection
    {
        $perPage = $request->get('per_page', 20);

        $query = QueryBuilder::for(Product::class)
            ->defaultSort('name')
            ->allowedFilters([
                'name',
                'price'
            ])
            ->allowedSorts([
                'name',
                'price',
                'created_at',
                'updated_at'
            ]);

        $products = $query->paginate($perPage);
        return new ProductCollection($products);
    }

    public function view(int $id, ViewProductAction $action): ProductListResource|JsonResponse
    {
        return $action($id);
    }

    public function create(CreateProductRequest $request, CreateProductAction $action): ProductListResource
    {
        $data = CreateProductDTO::fromRequest($request);
        return $action($data);
    }

    public function update(int $id, UpdateProductRequest $request, UpdateProductAction $action): ProductListResource|JsonResponse
    {
        $data = UpdateProductDTO::fromRequest($request);
        return $action($data, $id);
    }

    public function delete(int $id, DeleteProductAction $action): ProductListResource|JsonResponse
    {
        return $action($id);
    }
}
