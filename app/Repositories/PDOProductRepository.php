<?php

namespace App\Repositories;

use App\Database;
use Doctrine\DBAL\Exception;

class PDOProductRepository implements ProductRepository
{
    /**
     * @throws Exception
     */
    public function getAll(): array
    {
        return Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('products')
            ->executeQuery()
            ->fetchAllAssociative();
    }

    /**
     * @throws Exception
     */
    public function getProductTypes(): array
    {
        return Database::connection()
            ->createQueryBuilder()
            ->select('type')
            ->from('products')
            ->executeQuery()
            ->fetchAllAssociative();
    }

    /**
     * @throws Exception
     */
    public function add(array $productData): void
    {
        Database::connection()
            ->insert('products', [
                'sku' => $productData['sku'],
                'name' => $productData['name'],
                'price' => $productData['price'],
                'type' => $productData['type'],
                'attribute_value' => $productData['attribute_value']
            ]);
    }

    /**
     * @throws Exception
     */
    public function delete(int $id): void
    {
        Database::connection()
            ->delete('products', ['id' => $id]);
    }
}
