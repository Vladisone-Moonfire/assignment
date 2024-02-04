<?php

namespace App\Src\Domain\Product\DataTransferObjects;

use App\Src\Api\Product\Requests\CreateProductRequest;
use App\Src\Domain\Product\Models\Product;
use Spatie\LaravelData\Data;

class CreateProductDTO extends Data
{
    public function __construct(
        public string $name,
        public float $price
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            price: $data['price']
        );
    }

    public static function fromRequest(CreateProductRequest $request): self
    {
        return new self(
            name: $request->input('name'),
            price: $request->input('price')
        );
    }

    public static function fromModel(Product $product, array $overrides = []): self
    {
        return new self(
            name: $product->name,
            price: $product->price
        );
    }
}
