<?php

namespace App\Repositories;

interface ProductRepository
{
    public function getAll(): array;

    public function getProductTypes(): array;

    public function add(array $productData): void;

    public function delete(int $id): void;
}
