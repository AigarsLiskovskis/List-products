<?php

namespace App\Models;

class Furniture extends Product
{
    private string $attribute = 'Dimensions';
    private static array $field =
        [
            'fieldId' => 'Furniture',
            'units' => 'CM',
            'fields' => ['height', 'width', 'length'],
            'description' => 'dimensions'
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
