<?php

namespace App\Models;

class Dvd extends Product
{
    private string $attribute = 'Size';
    private static array $field =
        [
            'fieldId' => 'DVD',
            'units' => 'MB',
            'fields' => ['size'],
            'description'=> 'size'
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
