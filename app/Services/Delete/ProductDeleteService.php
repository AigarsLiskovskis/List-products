<?php

namespace App\Services\Delete;

use App\Repositories\ProductRepository;
use App\Repositories\PDOProductRepository;
use Doctrine\DBAL\Exception;

class ProductDeleteService
{
    private ProductRepository $productRepository;

    public function __construct()
    {
        $this->productRepository = new PDOProductRepository();
    }

    /**
     * @throws Exception
     */
    public function execute(ProductDeleteRequest $request): void
    {
        $productDeleteId = $request->getProductDeleteId();

        foreach ($productDeleteId as $deleteId){
            $this->productRepository->delete($deleteId);
        }
    }
}
