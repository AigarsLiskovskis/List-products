<?php

namespace App\Controllers;

use App\Redirect;
use App\Services\UniqSKU\SKUUniqueRequest;
use App\Services\UniqSKU\SKUUniqueService;
use App\Validation\ProductValidation;
use App\Views\View;
use App\Services\Add\ProductAddRequest;
use App\Services\Add\ProductAddService;
use App\Services\Delete\ProductDeleteRequest;
use App\Services\Delete\ProductDeleteService;
use App\Services\Type\ProductTypeService;
use App\Services\Index\ProductIndexService;
use Doctrine\DBAL\Exception;

class ProductController
{
    private ProductIndexService $indexService;
    private ProductAddService $addService;
    private ProductDeleteService $deleteService;
    private ProductTypeService $typeService;

    public function __construct(
        ProductIndexService  $indexService,
        ProductAddService    $addService,
        ProductDeleteService $deleteService,
        ProductTypeService   $typeService,
    )
    {
        $this->indexService = $indexService;
        $this->addService = $addService;
        $this->deleteService = $deleteService;
        $this->typeService = $typeService;
    }

    public function index(): View
    {
        $products = $this->indexService->execute();
        return new View('Products/index', [
            'products' => $products,
        ]);
    }

    public function create(): View
    {
        $types = $this->typeService->execute();
        return new View('Products/create', ['types' => $types]);
    }

    public function listTypes(): View
    {
        // Call static function for selected product type
        $fieldData = call_user_func(array('\\App\\Models\\' . $_POST['selector'], "getField"));
        return new View('Products/typeAttributes', ['fieldData' => $fieldData]);
    }

    /**
     * @throws Exception
     */
    public static function uniqueSKU($sku): bool
    {
        // Search in DB if input SKU is unique
        return (new SKUUniqueService())->execute(new SKUUniqueRequest($sku));
    }

    public function store(): void
    {
        // Validation returns array of fields and errors
        $validate = (new ProductValidation($_POST))->validate();
        if ($validate['errors']) {
            echo json_encode($validate);
        } else {
            // Fields validated, prepare attribute values and saving product in DB
            $productData = $_POST;
            $values = [];
            foreach ($productData['attributes'] as $attribute) {
                $values[] = $attribute['value'];
            }
            $productData['attributes'] = implode('x', $values);
            $this->addService
                ->execute(new ProductAddRequest($productData));
            echo json_encode($validate);
            exit;
        }
    }

    /**
     * @throws Exception
     */
    public function delete(): Redirect
    {
        if ($_POST['delete-products']) {
            $this->deleteService
                ->execute(new ProductDeleteRequest($_POST['delete-products']));
            return new Redirect('/');
        }

        return new Redirect('/');
    }
}
