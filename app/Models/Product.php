<?php

namespace App\Models;

abstract class Product
{
    private int $id;
    private string $sku;
    private string $name;
    private float $price;
    private string $type;
    protected string $attributeValue;

    public function __construct(
        int    $id,
        string $sku,
        string $name,
        float  $price,
        string $type,
        string $attributeValue
    )
    {
        $this->id = $id;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->type = $type;
        $this->attributeValue = $attributeValue;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): string
    {
        return number_format($this->price, 2, '.') . ' $';
    }

    public function getType(): string
    {
        return $this->type;
    }
}
