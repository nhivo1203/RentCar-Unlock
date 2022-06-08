<?php

namespace Nhivonfq\Tests\Validate;

use Dotenv\Dotenv;
use Nhivonfq\Unlock\Database\Database;
use Nhivonfq\Unlock\Validate\LoginValidate;
use PHPUnit\Framework\TestCase;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

class LoginValidateTest extends TestCase
{
    /**
     * @dataProvider loginSuccessProvider
     * @return void
     */
    public function testLoginrules($params)
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


        $loginValidate = new LoginValidate();
        $loginValidate->loadData($params);
        $isValid = $loginValidate->validate();
        $this->assertTrue($isValid);
    }


    /**
     * @return array[]
     */
    public function loginSuccessProvider()
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'email' => 'vonhi1604@gmail.com',
                    'password' => '123456789',
                ],
            ],
            'happy-case-2' => [
                'params' => [
                    'email' => 'phutrungcm@gmail.com',
                    'password' => '123456789',
                ],
            ]
        ];
    }
}
