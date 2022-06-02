<?php

namespace Nhivonfq\Tests\Services;

use Couchbase\User;
use Nhivonfq\Unlock\Models\UserModel;
use Nhivonfq\Unlock\Repository\UserRepository;
use Nhivonfq\Unlock\Request\RegisterRequest;
use Nhivonfq\Unlock\Services\RegisterServices;
use PHPUnit\Framework\TestCase;

class RegisterServicesTest extends TestCase
{
    /**
     * @dataProvider registerSuccessProvider
     * @param array $params
     * @param array $expected
     * @return void
     */
    public function testRegisterSuccess(array $params, bool $expected) {
        $registerRequest = new RegisterRequest();
        $user = new UserModel();
        $registerRequest->fromArray($params);
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('saveUser')->willReturn($params['isSave']);
        $registerServices = new RegisterServices($userRepositoryMock);
        $isRegisterResult = $registerServices->register($registerRequest);
        var_dump($isRegisterResult);die();
        $this->assertEquals($expected, $isRegisterResult);
    }


    /**
     * @return array[]
     */
    public function registerSuccessProvider()
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'firstname' => 'Vo',
                    'lastname' => 'Thien',
                    'email' => 'vothien1203@gmail.com',
                    'status' => 0,
                    'username' => 'vothien1203',
                    'password' => '123456789',
                    'isSave' => true,
                ],
                'expected' => true

            ],
            'happy-case-2' => [
                'params' => [
                    'firstname' => 'Vo',
                    'lastname' => 'Long',
                    'email' => 'volong1604@gmail.com',
                    'status' => 0,
                    'username' => 'volong1604',
                    'password' => '123456789',
                    'isSave' => true,
                ],
                'expected' => true
            ],
        ];
    }
}
