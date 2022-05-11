<?php

namespace App\Models;

class Book extends Product
{
    private string $attribute = 'Weight';
    private static array $field =
        [
            'fieldId' => 'Book',
            'units' => 'KG',
            'fields' => ['weight'],
            'description' => 'weight'
        ];

    public function getAttribute(): string
    {
        return $this->attribute;
    }

    public function getAttributeUnit(): string
    {
        return self::$field['units'];
    }

    public function getAttributeValue(): string
    {
        return $this->attributeValue;
    }

    public static function getField(): array
    {
        return self::$field;
    }
}
