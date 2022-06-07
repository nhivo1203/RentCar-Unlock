<?php

namespace Nhivonfq\Unlock\Validate;

use Nhivonfq\Unlock\boostrap\Validate;

class CreateBookingValidate extends Validate
{

    public int $booking_id = 0;
    public int $user_id = 0;
    public int $car_id = 0;
    public string $check_in = '';
    public string $check_out = '';
    public int $total = 0;

    public function rules(): array
    {
        return [
            'user_id' => [self::RULE_REQUIRED],
            'car_id' => [self::RULE_REQUIRED],
            'check_in' => [self::RULE_REQUIRED],
            'check_out' => [self::RULE_REQUIRED],
            'total' => [self::RULE_REQUIRED],
        ];
    }
}
