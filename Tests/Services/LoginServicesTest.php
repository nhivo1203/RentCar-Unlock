<?php

namespace Nhivonfq\Tests\Services;

use Nhivonfq\Unlock\Models\UserModel;
use Nhivonfq\Unlock\Repository\UserRepository;
use Nhivonfq\Unlock\Request\LoginRequest;
use Nhivonfq\Unlock\Services\LoginServices;
use Nhivonfq\Unlock\Services\SessionServices;
use PHPUnit\Framework\TestCase;

class LoginServicesTest extends TestCase
{
    public function testIsGuest() {
        unset($_SESSION['user_id']);
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $session = new SessionServices();
        $loginServices = new LoginServices($userRepositoryMock, $session);
        $isGuest = $loginServices::isGuest();

        $this->assertTrue($isGuest);
    }

    /**
     * @dataProvider loginSuccessProvider
     * @param array $params
     * @param array $expected
     * @return void
     */
    public function testLoginSuccess(array $params,array $expected):void
    {
        $loginRequest = new LoginRequest();
        $loginRequest->fromArray($params);
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findOne')->willReturn($params['userReturn']);
        $sessionServicesMock = $this->getMockBuilder(SessionServices::class)->disableOriginalConstructor()->getMock();
        $loginServices = new LoginServices($userRepositoryMock, $sessionServicesMock);
        $isLoginResult = $loginServices->login($loginRequest);
        $this->assertTrue($isLoginResult);
    }

    /**
     * @dataProvider loginFailedProvider
     * @param $params
     * @param $expected
     * @return void
     */
    public function testLoginFailed(array $params,array $expected):void
    {
        $loginRequest = new LoginRequest();
        $loginRequest->fromArray($params);
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findOne')->willReturn($params['userReturn']);
        $sessionServicesMock = $this->getMockBuilder(SessionServices::class)->disableOriginalConstructor()->getMock();
        $loginServices = new LoginServices($userRepositoryMock, $sessionServicesMock);
        $isLoginResult = $loginServices->login($loginRequest);
        $this->assertFalse($isLoginResult);
    }

    public function testLogOut() {
        $userRepository = new UserRepository();
        $session = new SessionServices();
        $loginServices = new LoginServices($userRepository, $session);
        $session->set('user_id',7);
        $loginServices->logout();
        $checkHasSession = $session->hasSession('user_id');
        $this->assertFalse($checkHasSession);
    }

    private function getUser(int $id, string $email, string $password): UserModel
    {
        $user = new UserModel();
        $user->setId($id);
        $user->setEmail($email);
        $user->setPassword($password);

        return $user;
    }

    private function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
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
                    'userReturn' => $this->getUser(7, 'vonhi1604@gmail.com', $this->hashPassword('123456789')),
                ],
                'expected' => [
                    'login' => true
                ]
            ],
            'happy-case-2' => [
                'params' => [
                    'email' => 'phutrungcm@gmail.com',
                    'password' => '123456789',
                    'userReturn' => $this->getUser(9, 'phutrungcm@gmail.com', $this->hashPassword('123456789')),
                ],
                'expected' => [
                    'login' => true
                ]
            ]
        ];
    }

    /**
     * @return array[]
     */
    public function loginFailedProvider()
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'email' => 'hehehegege@gmail.com',
                    'password' => '12345678',
                    'userReturn' => $this->getUser(7, 'hehehe@gmail.com', $this->hashPassword('123456789')),
                ],
                'expected' => [
                    'login' => false
                ]
            ],
            'happy-case-2' => [
                'params' => [
                    'email' => 'hihihigege@gmail.com',
                    'password' => '12345678',
                    'userReturn' => $this->getUser(9, 'hihihi@gmail.com', $this->hashPassword('123456789')),
                ],
                'expected' => [
                    'login' => false
                ]
            ]
        ];
    }

}
