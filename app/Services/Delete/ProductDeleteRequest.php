<?php

namespace App\Services\Delete;

class ProductDeleteRequest
{
    private array $productDeleteId;

    public function __construct(array $productDeleteId)
    {
        $this->productDeleteId = $productDeleteId;
    }

    public function getProductDeleteId(): array
    {
        return $this->productDeleteId;
    }
}
