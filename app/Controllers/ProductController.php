<?php

namespace App\Controllers;

use App\Redirect;
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
        ProductTypeService   $typeService
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
        return new View('Products/create', ['types'=> $types]);
    }

    public function listTypes(): View
    {
        $fieldData = call_user_func(array('\\App\\Models\\'.$_POST['selector'], "getField"));
        return new View('Products/typeAttributes', ['fieldData'=> $fieldData]);
    }

    public function store(): Redirect
    {


        //validate
        var_dump($_POST);
        exit;

        //attribute_value adjust array_slice()

        $productData = [$_POST];
        $this->addService
            ->execute(new ProductAddRequest($productData));
        return new Redirect('/');
    }

    /**
     * @throws Exception
     */
    public function delete(): Redirect
    {
        if($_POST['delete-products']){
            $this->deleteService
                ->execute(new ProductDeleteRequest($_POST['delete-products']));
            return new Redirect('/');
        }
        return new Redirect('/');
    }
}
