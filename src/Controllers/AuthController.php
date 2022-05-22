<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\boostrap\Application;
use Nhivonfq\Unlock\boostrap\Controller;
use Nhivonfq\Unlock\boostrap\Request;
use Nhivonfq\Unlock\boostrap\Response;
use Nhivonfq\Unlock\Validate\LoginValidate;
use Nhivonfq\Unlock\Validate\UserValidate;

class AuthController extends Controller
{
    /**
     * @return array|false|string|string[]
     */
    public function login(Request $request, Response $response)
    {
        $loginValidate = new LoginValidate();

        if($request->isPost()){
            $loginValidate->loadData($request->getBody());
            if ($loginValidate->validate() && $loginValidate->login()) {
                $response->redirect('/');
                return true;
            }
        }

        $this->setLayout('auth');

        return $this->render('login', [
            'model' => $loginValidate
        ]);
    }


    /**
     * @param Request $request
     * @return array|false|string|string[]
     */
    public function register(Request $request)
    {

        $registerValidate = new UserValidate();
        if ($request->isPost()) {

            $registerValidate->loadData($request->getBody());

            if ($registerValidate->validate() && $registerValidate->register()) {
                Application::$app->response->redirect('/');
                Application::$app->session->setFlash('success','Thanks for registering');
            }

            return $this->render('register', ['model' => $registerValidate]);
        }

        $this->setLayout('auth');

        return $this->render('register', ['model' => $registerValidate]);

    }
}
