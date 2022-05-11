<?php

namespace App\Services\Index;

use App\Repositories\ProductRepository;

class ProductIndexService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(): array
    {
        $productList = $this->productRepository->getAll();
        $products = [];
        foreach ($productList as $product) {
            $class = "App\Models\\{$product['type']}";
            $products[] = new $class(
                $product['id'],
                $product['sku'],
                $product['name'],
                $product['price'],
                $product['type'],
                $product['attribute_value'],
            );
        }

        return (new ProductIndexResponse($products))->getProducts();
    }
}
