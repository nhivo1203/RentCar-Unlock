<?php

namespace Nhivonfq\Tests\Controllers;

use Nhivonfq\Unlock\Controllers\AuthController;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Models\UserModel;
use Nhivonfq\Unlock\Services\LoginServices;
use Nhivonfq\Unlock\Services\RegisterServices;
use Nhivonfq\Unlock\Services\SessionServices;
use Nhivonfq\Unlock\Validate\LoginValidate;
use Nhivonfq\Unlock\Validate\RegisterValidate;
use PHPUnit\Framework\TestCase;

class AuthControllerTest extends TestCase
{
    protected UserModel $user;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->user = new UserModel();
        $this->user->setId(1);
        $this->user->setEmail('vonhi1604@gmail.com');
        $this->user->setPassword('$2y$10$9GHYfiHYUB7o4t5Wf2zwoe30CDZQP2sdutbBQTISD.LllNEeOxKEK');
    }

    public function testLoginSuccess() {
        $response = new Response();
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $loginServiceMock = $this->getMockBuilder(LoginServices::class)->disableOriginalConstructor()->getMock();
        $loginValidateMock = $this->getMockBuilder(LoginValidate::class)->disableOriginalConstructor()->getMock();
        $registerServiceMock = $this->getMockBuilder(RegisterServices::class)->disableOriginalConstructor()->getMock();
        $registerValidateMock = $this->getMockBuilder(RegisterValidate::class)->disableOriginalConstructor()->getMock();
        $requestMock->expects($this->once())->method('getBody')->willReturn([
            'email' => 'vonhi1604@gmail.com',
            'password' => '123456789'
        ]);
        $loginServiceMock->expects($this->once())->method('login')->willReturn(true);
        $loginValidateMock->expects($this->once())->method('validate')->willReturn(true);
        $controller = new AuthController(
            $registerValidateMock,
            $loginValidateMock,
            $requestMock,
            $response,
            $loginServiceMock,
            $registerServiceMock
        );
        $isLogin = $controller->login();
        $expectedResult = new Response();
        $expectedResult->setRedirectUrl('/');

        $this->assertEquals($expectedResult, $isLogin);
    }
}
