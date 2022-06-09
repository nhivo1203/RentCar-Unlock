<?php

namespace Nhivonfq\Tests\Controllers;

use Nhivonfq\Unlock\Controllers\LoginController;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Models\User;
use Nhivonfq\Unlock\Services\UserServices;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Validate\LoginValidate;
use PHPUnit\Framework\TestCase;

class LoginControllerTest extends TestCase
{
    /**
     * @dataProvider loginProvider
     * @param array $params
     * @return void
     */
    public function testLoginSuccess(array $params): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $response = new Response();
        $loginValidateMock = $this->getMockBuilder(LoginValidate::class)->disableOriginalConstructor()->getMock();
        $loginValidateMock->expects($this->once())->method('validate')->willReturn(true);
        $requestTransferMock = $this->getMockBuilder(RequestTransfer::class)->disableOriginalConstructor()->getMock();
        $requestTransferMock->method('getRequestArrayBody')->willReturn($params['userRequest']);
        $loginServicesMock = $this->getMockBuilder(UserServices::class)->disableOriginalConstructor()->getMock();
        $loginServicesMock->expects($this->once())->method('login')->willReturn($params['userReturn']);
        $loginController = new LoginController($loginValidateMock, $requestMock, $response, $loginServicesMock, $requestTransferMock);
        $loginResult = $loginController->login();

        $expectedResponse = new Response();
        $expectedResponse->redirect('/');

        $this->assertEquals($expectedResponse->getredirectUrl(), $loginResult->getredirectUrl());

    }

    /**
     * @dataProvider loginProvider
     * @param array $params
     * @return void
     */
    public function testLoginFailedWithValidate(array $params): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $response = new Response();
        $loginValidateMock = $this->getMockBuilder(LoginValidate::class)->disableOriginalConstructor()->getMock();
        $loginValidateMock->expects($this->once())->method('validate')->willReturn(false);
        $requestTransferMock = $this->getMockBuilder(RequestTransfer::class)->disableOriginalConstructor()->getMock();
        $requestTransferMock->method('getRequestArrayBody')->willReturn($params['userRequest']);
        $loginServicesMock = $this->getMockBuilder(UserServices::class)->disableOriginalConstructor()->getMock();
        $loginServicesMock->method('login')->willReturn($params['userReturn']);
        $loginController = new LoginController($loginValidateMock, $requestMock, $response, $loginServicesMock, $requestTransferMock);
        $loginResult = $loginController->login();

        $expectedResponse = new Response();
        $expectedResponse->setTemplate('login');

        $this->assertEquals($expectedResponse->getTemplate(), $loginResult->getTemplate());

    }

    /**
     * @dataProvider loginProvider
     * @param array $params
     * @return void
     */
    public function testLoginFailedWithServices(array $params): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $response = new Response();
        $loginValidateMock = $this->getMockBuilder(LoginValidate::class)->disableOriginalConstructor()->getMock();
        $loginValidateMock->expects($this->once())->method('validate')->willReturn(true);
        $requestTransferMock = $this->getMockBuilder(RequestTransfer::class)->disableOriginalConstructor()->getMock();
        $requestTransferMock->method('getRequestArrayBody')->willReturn($params['userRequest']);
        $loginServicesMock = $this->getMockBuilder(UserServices::class)->disableOriginalConstructor()->getMock();
        $loginServicesMock->method('login')->willReturn(false);
        $loginController = new LoginController($loginValidateMock, $requestMock, $response, $loginServicesMock, $requestTransferMock);
        $loginResult = $loginController->login();

        $expectedResponse = new Response();
        $expectedResponse->setTemplate('login');

        $this->assertEquals($expectedResponse->getTemplate(), $loginResult->getTemplate());

    }


    /**
     * @dataProvider loginProvider
     * @param array $params
     * @return void
     */
    public function testLoginWithGetMethod(array $params): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $response = new Response();
        $loginValidateMock = $this->getMockBuilder(LoginValidate::class)->disableOriginalConstructor()->getMock();
        $loginValidateMock->expects($this->once())->method('validate')->willReturn(true);
        $requestTransferMock = $this->getMockBuilder(RequestTransfer::class)->disableOriginalConstructor()->getMock();
        $requestTransferMock->method('getRequestArrayBody')->willReturn($params['userRequest']);
        $loginServicesMock = $this->getMockBuilder(UserServices::class)->disableOriginalConstructor()->getMock();
        $loginServicesMock->method('login')->willReturn(false);
        $loginController = new LoginController($loginValidateMock, $requestMock, $response, $loginServicesMock, $requestTransferMock);
        $loginResult = $loginController->login();

        $expectedResponse = new Response();
        $expectedResponse->renderView('login');

        $this->assertEquals($expectedResponse->getTemplate(), $loginResult->getTemplate());

    }

    public function testLogOutSuccess(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $response = new Response();
        $loginValidateMock = $this->getMockBuilder(LoginValidate::class)->disableOriginalConstructor()->getMock();
        $requestTransferMock = $this->getMockBuilder(RequestTransfer::class)->disableOriginalConstructor()->getMock();
        $loginServicesMock = $this->getMockBuilder(UserServices::class)->disableOriginalConstructor()->getMock();
        $loginServicesMock->method('logout');
        $loginController = new LoginController($loginValidateMock, $requestMock, $response, $loginServicesMock, $requestTransferMock);
        $logoutResult = $loginController->logout();
        $expectedResponse = new Response();
        $expectedResponse->redirect('/');

        $this->assertEquals($expectedResponse->getRedirectUrl(), $logoutResult->getRedirectUrl());
    }

    public function testLogOutWithGetMethod(): void
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $requestMock->method('getMethod')->willReturn('get');
        $response = new Response();
        $loginValidateMock = $this->getMockBuilder(LoginValidate::class)->disableOriginalConstructor()->getMock();
        $requestTransferMock = $this->getMockBuilder(RequestTransfer::class)->disableOriginalConstructor()->getMock();
        $loginServicesMock = $this->getMockBuilder(UserServices::class)->disableOriginalConstructor()->getMock();
        $loginController = new LoginController($loginValidateMock, $requestMock, $response, $loginServicesMock, $requestTransferMock);
        $logoutResult = $loginController->logout();
        $expectedResponse = new Response();
        $expectedResponse->redirect('/');

        $this->assertEquals($expectedResponse->getRedirectUrl(), $logoutResult->getRedirectUrl());
    }

    private function getUser(int $id, string $email, string $password): User
    {
        $user = new User();
        $user->setId($id);
        $user->setEmail($email);
        $user->setPassword($password);

        return $user;
    }

    private function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }


    public function loginProvider()
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'userRequest' => [
                        'email' => 'ngocyen@gmail.com',
                        'password' => 'ngocyen2014'
                    ],
                    'userReturn' => $this->getUser(1, 'ngocyen@gmail.com', $this->hashPassword('ngocyen2014')),
                ],
                'expected' => [
                    'user' => $this->getUser(1, 'ngocyen@gmail.com', $this->hashPassword('ngocyen2014'))
                ]
            ],
            'happy-case-2' => [
                'params' => [
                    'userRequest' => [
                        'email' => 'vomo@gmail.com',
                        'password' => 'vomo2110'
                    ],
                    'userReturn' => $this->getUser(2, 'vomo@gmail.com', $this->hashPassword('vomo2110')),
                ],
                'expected' => [
                    'user' => $this->getUser(2, 'vomo@gmail.com', $this->hashPassword('vomo2110'))
                ]
            ]
        ];
    }
}
