<?php

namespace App\Services\Add;

use App\Repositories\ProductRepository;

class ProductAddService
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(ProductAddRequest $request): void
    {
        $addProduct = $request->getAddProduct();
        $this->productRepository->add($addProduct);
    }
}
