<?php

namespace App\Services\Add;

class ProductAddRequest
{
    private array $productData;

    public function __construct(array $productData)
    {
        $this->productData = $productData;
    }

    public function getAddProduct(): array
    {
        return $this->productData;
    }
}
