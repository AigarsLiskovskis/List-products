<?php

namespace App\Services\UniqSKU;

class SKUUniqueRequest
{
    private string $sku;

    public function __construct(string $sku)
    {
        $this->sku = $sku;
    }

    public function getSKU(): string
    {
        return $this->sku;
    }
}
