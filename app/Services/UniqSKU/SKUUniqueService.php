<?php

namespace App\Services\UniqSKU;

use App\Repositories\PDOProductRepository;
use App\Repositories\ProductRepository;
use Doctrine\DBAL\Exception;

class SKUUniqueService
{
    private ProductRepository $productRepository;

    public function __construct()
    {
        $this->productRepository = new PDOProductRepository();
    }

    /**
     * @throws Exception
     */
    public function execute(SKUUniqueRequest $request): bool
    {
        $sku = $request->getSKU();

        $response = $this->productRepository->getSKU($sku);

        return (new SKUUniqueResponse($response))->getResponse();
    }
}
