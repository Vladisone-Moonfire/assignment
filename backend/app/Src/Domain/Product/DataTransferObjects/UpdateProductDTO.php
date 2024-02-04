<?php

namespace App\Src\Domain\Product\DataTransferObjects;

use App\Src\Api\Product\Requests\UpdateProductRequest;
use App\Src\Domain\Product\Models\Product;
use Spatie\LaravelData\Data;

class UpdateProductDTO extends Data
{
    public function __construct(
        public ?string $name,
        public ?float $price
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            price: $data['price'] ?? null
        );
    }

    public static function fromRequest(UpdateProductRequest $request): self
    {
        return new self(
            name: $request->input('name') ?? null,
            price: $request->input('price') ?? null
        );
    }

    public static function fromModel(Product $product, array $overrides = []): self
    {
        return new self(
            name: $product->name ?? null,
            price: $product->price ?? null
        );
    }
}
