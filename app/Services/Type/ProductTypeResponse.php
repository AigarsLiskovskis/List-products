<?php

namespace App\Services\Type;

class ProductTypeResponse
{
    private array $productTypes;

    public function __construct(array $productTypes)
    {
        $this->productTypes = $productTypes;
    }

    public function getProductTypes(): array
    {
        return $this->productTypes;
    }
}
