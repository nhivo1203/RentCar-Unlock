<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Request\LoginRequest;
use Nhivonfq\Unlock\Services\LoginServices;
use Nhivonfq\Unlock\Validate\LoginValidate;

class LoginController
{
    private LoginServices $loginServices;
    private LoginValidate $loginValidate;
    private Request $request;
    private Response $response;


    public function __construct(
        LoginValidate    $loginValidate,
        Request          $request,
        Response         $response,
        LoginServices    $loginServices,
    )
    {
        $this->loginValidate = $loginValidate;
        $this->loginServices = $loginServices;
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function login():Response
    {
        if ($this->request->isPost()) {
            $loginRequest = new LoginRequest();
            $loginRequest = $loginRequest->fromArray($this->request->getBody());
            $this->loginValidate->loadData($this->request->getBody());
            if ($this->loginValidate->validate() &&
                $this->loginServices->login($loginRequest)
            ) {
                $this->response->setRedirectUrl('/');
            }
        }
        return $this->response->renderView('login');
    }

    /**
     * @return Response
     */
    public function logout(): Response
    {
        if ($this->request->isPost()) {
            $this->loginServices->logout();
            return $this->response->redirect('/');
        }
        return $this->response->redirect('/');
    }

}