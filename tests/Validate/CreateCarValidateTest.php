<?php

namespace Nhivonfq\Tests\Validate;

use Nhivonfq\Unlock\Database\Database;
use Nhivonfq\Unlock\Validate\CreateCarValidate;
use PHPUnit\Framework\TestCase;

class CreateCarValidateTest extends TestCase
{
    /**
     * @dataProvider createCarSuccessProvider
     * @param array $params
     * @return void
     */
    public function testCreateCarSuccessRules(array $params): void
    {
        $createCarValidate = new CreateCarValidate();
        $createCarValidate->loadData($params);
        $isValid = $createCarValidate->validate();
        $this->assertTrue($isValid);
    }

    /**
     * @dataProvider createCarFailedProvider
     * @param array $params
     * @return void
     */
    public function testCreateCarFailedRules(array $params): void
    {
        $createCarValidate = new CreateCarValidate();
        $createCarValidate->loadData($params);
        $isValid = $createCarValidate->validate();
        $this->assertFalse($isValid);
    }

    public function createCarSuccessProvider(): array
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'name' => 'Mercedes Mayback',
                    'type' => 'Premium',
                    'brand' => 'Mercedes',
                    'price' => '17000',
                ],
            ],
            'happy-case-2' => [
                'params' => [
                    'name' => 'Mercedes Brabus',
                    'type' => 'Premium',
                    'brand' => 'Mercedes',
                    'price' => '10000',
                ],
            ],
        ];
    }

    public function createCarFailedProvider(): array
    {
        return [
            'bad-case-1' => [
                'params' => [
                    'name' => '',
                    'type' => '',
                    'brand' => 'Mercedes',
                    'price' => '10',
                ],
            ],
            'bad-case-2' => [
                'params' => [
                    'name' => 'Mercedes Brabus',
                    'type' => 'Premium',
                    'brand' => '',
                    'price' => 9999999999999999,
                ],
            ],
        ];
    }
}
