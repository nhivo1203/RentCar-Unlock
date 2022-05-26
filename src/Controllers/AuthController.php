<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\App\View;
use Nhivonfq\Unlock\boostrap\Application;
use Nhivonfq\Unlock\boostrap\Controller;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Repository\UserRepository;
use Nhivonfq\Unlock\Request\LoginRequest;
use Nhivonfq\Unlock\Services\UserServices;
use Nhivonfq\Unlock\Validate\LoginValidate;
use Nhivonfq\Unlock\Validate\RegisterValidate;


class AuthController extends Controller
{
    private RegisterValidate $registerValidate;
    private LoginValidate $loginValidate;
    private UserRepository $userRepository;
    private Request $request;
    private Response $response;

    public function __construct(
        RegisterValidate $registerValidate,
        LoginValidate    $loginValidate,
        Request          $request,
        Response         $response,
        UserRepository   $userRepository,
    )
    {
        $this->loginValidate = $loginValidate;
        $this->registerValidate = $registerValidate;
        $this->userRepository = $userRepository;
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return
     */
    public function login()
    {

        if ($this->request->isPost()) {
            $loginRequest = new LoginRequest();
            $loginRequest = $loginRequest->fromArray($this->request->getBody());
            $this->loginValidate->loadData($this->request->getBody());
            if ($this->loginValidate->validate() &&
                UserServices::$userServices->login($loginRequest)
            ) {
                View::redirect('/');
                return true;
            }
        }


        return $this->response->renderView('login');
    }


    /**
     * @param Request $request
     * @return array|false|string|string[]
     */
    public function register()
    {
        if ($this->request->isPost()) {

            $this->registerValidate->loadData($this->request->getBody());

            if ($this->registerValidate->validate()
                && $this->registerValidate->register()
                && $this->userRepository->save($this->registerValidate->user)) {
                Application::$app->response->redirect('/');
                UserServices::$userServices->session->setFlash('success', 'Thanks for registering');
            }

            return $this->render('register', ['model' => $this->registerValidate]);
        }

        $this->setLayout('auth');

        return $this->render('register', ['model' => $this->registerValidate]);

    }

    public function logout()
    {
        if ($this->request->isPost()) {
            UserServices::$userServices->logout();
            $this->response->redirect('/');
        }
        $this->response->redirect('/');
    }
}
