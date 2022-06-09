<?php

namespace Nhivonfq\Tests\Validate;

use Nhivonfq\Unlock\Validate\CreateBookingValidate;
use PHPUnit\Framework\TestCase;

class CreateBookingValidateTest extends TestCase
{
    /**
     * @dataProvider createBookingSuccessProvider
     * @param array $params
     * @return void
     */
    public function testCreateBookingSuccessRules(array $params): void
    {
        $createCarValidate = new CreateBookingValidate();
        $createCarValidate->loadData($params);
        $isValid = $createCarValidate->validate();
        $this->assertTrue($isValid);
    }

    /**
     * @dataProvider createBookingFailedProvider
     * @param array $params
     * @return void
     */
    public function testCreateBookingFailedRules(array $params): void
    {
        $createCarValidate = new CreateBookingValidate();
        $createCarValidate->loadData($params);
        $isValid = $createCarValidate->validate();
        $this->assertFalse($isValid);
    }

    public function createBookingSuccessProvider(): array
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'user_id' => 1,
                    'car_id' => 2,
                    'check_in' => '2022-06-06',
                    'check_out' => '2022-06-07',
                    'total' => 17000
                ],
            ],
            'happy-case-2' => [
                'params' => [
                    'user_id' => 4,
                    'car_id' => 3,
                    'check_in' => '2022-06-08',
                    'check_out' => '2022-06-09',
                    'total' => 10000
                ],
            ],
        ];
    }

    public function createBookingFailedProvider(): array
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'user_id' => 1,
                    'car_id' => 2,
                    'check_in' => '',
                    'check_out' => '',
                    'total' => 17000
                ],
            ],
        ];
    }
}
