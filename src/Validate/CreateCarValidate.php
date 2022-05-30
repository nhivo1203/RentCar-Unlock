<?php

namespace Nhivonfq\Unlock\Validate;

use Nhivonfq\Unlock\boostrap\Validate;

class CreateCarValidate extends Validate
{
    public string $name = "";
    public string $type = "";
    public string $brand = "";
    public string $image = "";
    public int $price = 0;

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'type' => [self::RULE_REQUIRED],
            'brand' => [self::RULE_REQUIRED],
            'image' => [self::RULE_REQUIRED],
            'price' => [self::RULE_REQUIRED],
        ];
    }
}
