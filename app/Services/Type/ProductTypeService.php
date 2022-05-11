<?php

namespace App\Services\Type;

use App\Repositories\ProductRepository;

class ProductTypeService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(): array
    {
        $getProductTypes = $this->productRepository->getProductTypes();

        $productTypes = [];
        foreach ($getProductTypes as $product) {
            $productTypes[] = $product['type'];
        }

        return (new ProductTypeResponse(array_unique($productTypes)))->getProductTypes();
    }
}
