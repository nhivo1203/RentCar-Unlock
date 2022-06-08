<?php

namespace Nhivonfq\Tests\Validate;

use Dotenv\Dotenv;
use Nhivonfq\Unlock\Database\Database;
use Nhivonfq\Unlock\Validate\RegisterValidate;
use PHPUnit\Framework\TestCase;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();


class RegisterValidateTest extends TestCase
{
    /**
     * @dataProvider registerSuccessProvider
     * @param array $params
     * @return void
     */
    public function testRegisterSuccessRules(array $params): void
    {
        $config = [
            'db' => [
                'server' => $_ENV['DB_SERVER'],
                'port' => $_ENV['DB_PORT'],
                'name' => $_ENV['DB_NAME'],
                'user' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASSWORD'],
            ]
        ];

        Database::getConnection($config['db']);


        $registerValidate = new RegisterValidate();
        $registerValidate->loadData($params);
        $isValid = $registerValidate->validate();
        $this->assertTrue($isValid);
    }

    /**
     * @dataProvider registerFailedProvider
     * @param array $params
     * @return void
     */
    public function testRegisterFailedRules(array $params): void
    {
        $config = [
            'db' => [
                'server' => $_ENV['DB_SERVER'],
                'port' => $_ENV['DB_PORT'],
                'name' => $_ENV['DB_NAME'],
                'user' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASSWORD'],
            ]
        ];

        Database::getConnection($config['db']);


        $registerValidate = new RegisterValidate();
        $registerValidate->loadData($params);
        $isValid = $registerValidate->validate();
        $this->assertFalse($isValid);
    }

    public function registerSuccessProvider()
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'firstname' => 'Vo',
                    'lastname' => 'Thien',
                    'email' => 'vothien1203@gmail.com',
                    'username' => 'vothien1203',
                    'password' => '123456789',
                    'confirmPassword' => '123456789'
                ],
            ],
            'happy-case-2' => [
                'params' => [
                    'firstname' => 'Vo',
                    'lastname' => 'Long',
                    'email' => 'volong1604@gmail.com',
                    'username' => 'volong1604',
                    'password' => '123456789',
                    'confirmPassword' => '123456789'
                ],
            ],
        ];
    }

    public function registerFailedProvider()
    {
        return [
            'worse-case-1' => [
                'params' => [
                    'firstname' => 'Vo',
                    'lastname' => 'Thien',
                    'email' => 'vothien1203.com',
                    'username' => 'voth',
                    'password' => '1234',
                    'confirmPassword' => '123456789'
                ],
            ],
            'worse-case-2' => [
                'params' => [
                    'firstname' => 'Vo',
                    'lastname' => '',
                    'email' => 'vonhi1604@gmail.com',
                    'username' => 'vothdajksdbkasdkjaskasdhsajksakhdjkaskdsahdkjshadsajkdhaskjhdakj',
                    'password' => 'vothdajksdbkasdkjaskasdhsajksakhdjkaskdsahdkjshadsajkdhaskjhdakj',
                    'confirmPassword' => '123456789'
                ],
            ],
        ];
    }
}
