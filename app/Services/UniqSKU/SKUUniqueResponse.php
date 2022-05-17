<?php

namespace App\Services\UniqSKU;

class SKUUniqueResponse
{
    private bool $response;

    public function __construct(bool $response)
    {
        $this->response = $response;
    }

    public function getResponse(): bool
    {
        return $this->response;
    }
}
