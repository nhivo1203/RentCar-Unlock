<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\boostrap\Application;
use Nhivonfq\Unlock\boostrap\Controller;
use Nhivonfq\Unlock\boostrap\Request;
use Nhivonfq\Unlock\boostrap\Response;
use Nhivonfq\Unlock\Services\UserServices;
use Nhivonfq\Unlock\Validate\LoginValidate;
use Nhivonfq\Unlock\Validate\RegisterValidate;
use Nhivonfq\Unlock\Repository\UserRepository;


class AuthController extends Controller
{
    public RegisterValidate $registerValidate;
    public LoginValidate $loginValidate;
    public UserRepository $userRepository;

    public function __construct()
    {
        $this->loginValidate = new LoginValidate();
        $this->registerValidate = new RegisterValidate();
        $this->userRepository = new UserRepository();
    }

    /**
     * @return array|false|string|string[]
     */
    public function login(Request $request, Response $response)
    {

        if ($request->isPost()) {
            $this->loginValidate->loadData($request->getBody());
            if ($this->loginValidate->validate() &&
                $this->loginValidate->handleLogin()
                && UserServices::$userServices->login($this->loginValidate->user)) {
                $response->redirect('/');
                return true;
            }
        }

        $this->setLayout('auth');

        return $this->render('login', [
            'model' => $this->loginValidate
        ]);
    }


    /**
     * @param Request $request
     * @return array|false|string|string[]
     */
    public function register(Request $request)
    {
        if ($request->isPost()) {

            $this->registerValidate->loadData($request->getBody());

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
}
