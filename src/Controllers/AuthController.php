<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\App\View;
use Nhivonfq\Unlock\boostrap\Controller;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Request\LoginRequest;
use Nhivonfq\Unlock\Request\RegisterRequest;
use Nhivonfq\Unlock\Services\LoginServices;
use Nhivonfq\Unlock\Services\RegisterServices;
use Nhivonfq\Unlock\Validate\LoginValidate;
use Nhivonfq\Unlock\Validate\RegisterValidate;


class AuthController extends Controller
{
    private RegisterValidate $registerValidate;
    private LoginValidate $loginValidate;
    private Request $request;
    private Response $response;
    private LoginServices $loginServices;
    private RegisterServices $registerServices;

    public function __construct(
        RegisterValidate $registerValidate,
        LoginValidate    $loginValidate,
        Request          $request,
        Response         $response,
        LoginServices    $loginServices,
        RegisterServices $registerServices
    )
    {
        $this->loginValidate = $loginValidate;
        $this->registerValidate = $registerValidate;
        $this->loginServices = $loginServices;
        $this->registerServices = $registerServices;
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
    public function register(): Response
    {
        if ($this->request->isPost()) {
            $registerRequest = new RegisterRequest();
            $registerRequest = $registerRequest->fromArray($this->request->getBody());
            $this->registerValidate->loadData($this->request->getBody());
            if ($this->registerValidate->validate()
                && $this->registerServices->register($registerRequest)
            ) {
                View::redirect('/');
            }

            return $this->response->renderView('register', ['model' => $this->registerValidate]);
        }

        return $this->response->renderView('register', ['model' => $this->registerValidate]);
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
