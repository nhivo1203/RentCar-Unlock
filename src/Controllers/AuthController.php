<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\Core\Controller;
use Nhivonfq\Unlock\Core\Request;
use Nhivonfq\Unlock\Models\RegisterModel;

class AuthController extends Controller
{
    /**
     * @return array|false|string|string[]
     */
    public function login()
    {
        $this->setLayout('main');

        return $this->render('login', []);
    }


    /**
     * @param Request $request
     * @return AuthController|string
     */
    public function register(Request $request): AuthController|string
    {

        $registerModel = new RegisterModel();
        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());

            if ($registerModel->validate() && $registerModel->register()) {
                return 'Success';
            }



            return $this->render('register', ['model' => $registerModel]);
        }

        $this->setLayout('auth');

        return $this->render('register', ['model' => $registerModel]);

    }
}
