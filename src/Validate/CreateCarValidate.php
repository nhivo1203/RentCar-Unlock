<?php

namespace Nhivonfq\Unlock\Validate;

use Nhivonfq\Unlock\App\Validate;

class CreateCarValidate extends Validate
{
    public string $name = "";
    public string $type = "";
    public string $brand = "";
    public int $price = 0;

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'type' => [self::RULE_REQUIRED],
            'brand' => [self::RULE_REQUIRED],
            'price' => [self::RULE_REQUIRED,[self::RULE_MIN_PRICE, 'min_price' => 100],
                [self::RULE_MAX_PRICE, 'max_price' => 9999999]],
        ];
    }
}
