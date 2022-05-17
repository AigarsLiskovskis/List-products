<?php

namespace App\Validation;

use App\Controllers\ProductController;
use Doctrine\DBAL\Exception;

class ProductValidation
{
    private string $requireMessage = 'Please, submit required data';
    private string $typeMessage = 'Please, provide the data of indicated type';
    private array $data;
    private array $errors = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @throws Exception
     */
    private function validateSku(): void
    {
        $sku = trim($this->data['sku']);
        if (empty($sku)) {
            $this->errors['sku'] = $this->requireMessage;
            // If alphanumeric characters and SKU not in DB
        } elseif (!ctype_alnum($sku) || ProductController::uniqueSKU($sku)) {
            $this->errors['sku'] = $this->typeMessage;
        } else {
            $this->errors['sku'] = '';
        }
    }

    private function validateName(): void
    {
        $name = trim($this->data['name']);
        if (empty($name)) {
            $this->errors['name'] = $this->requireMessage;
        } else {
            $this->errors['name'] = '';
        }
    }

    private function validatePrice(): void
    {
        $price = trim($this->data['price']);
        if (empty($price)) {
            $this->errors['price'] = $this->requireMessage;
            // Is integer or float
        } elseif (!preg_match('/^\d+(?:\.\d+)?$/', $price)) {
            $this->errors['price'] = $this->typeMessage;
        } else {
            $this->errors['price'] = '';
        }
    }

    private function validateType(): void
    {
        $type = trim($this->data['type']);
        if (empty($type)) {
            $this->errors['type'] = $this->requireMessage;
        } else {
            $this->errors['type'] = '';
        }
    }

    private function validateAttribute(): void
    {
        if (!empty($this->data['type'])) {
            foreach ($this->data['attributes'] as $attributeValues) {
                $value = trim($attributeValues['value']);
                if (empty($value)) {
                    $this->errors[$attributeValues['name']] = $this->requireMessage;
                    // Is integer or float
                } elseif (!preg_match('/^\d+(?:\.\d+)?$/', $value)) {
                    $this->errors[$attributeValues['name']] = $this->typeMessage;
                } else {
                    $this->errors[$attributeValues['name']] = '';
                }
            }
        }
    }

    // Count errors to submit input values
    private function checkErrors(): void
    {
        $errorCount = 0;
        foreach ($this->errors as $error){
            if($error !== ""){
                $errorCount++;
            }
        }
        if($errorCount>0){
            $this->errors['errors'] = true;
        }else{
            $this->errors['errors'] = false;
        }
    }

    /**
     * @throws Exception
     */
    public function validate(): array
    {
        $this->validateSku();
        $this->validateName();
        $this->validatePrice();
        $this->validateType();
        $this->validateAttribute();
        $this->checkErrors();
        return $this->errors;
    }
}
