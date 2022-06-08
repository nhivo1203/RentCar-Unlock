<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\boostrap\Controller;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Request\LoginRequest;
use Nhivonfq\Unlock\Services\UserServices;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Validate\LoginValidate;

class LoginController extends Controller
{
    private UserServices $loginServices;
    private LoginValidate $loginValidate;


    public function __construct(
        LoginValidate   $loginValidate,
        Request         $request,
        Response        $response,
        UserServices    $loginServices,
        RequestTransfer $requestTransfer

    )
    {
        parent::__construct($request, $response, $requestTransfer);
        $this->loginValidate = $loginValidate;
        $this->loginServices = $loginServices;

    }

    /**
     * @return Response
     */
    public function login(): Response
    {
        if ($this->request->isGet()) {
            return $this->response->renderView('login');
        }
        $this->loginValidate->loadData($this->requestTransfer->getRequestArrayBody());
        if ($this->loginValidate->validate()) {
            $loginRequest = new LoginRequest();
            $loginRequest = $loginRequest->fromArray($this->requestTransfer->getRequestArrayBody());
            if ($this->loginServices->login($loginRequest)) {
                $this->response->setRedirectUrl('/');
            }
        }
        return $this->response->renderView('login', ['errors' => $this->loginValidate->getErrors()]);
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
