<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\boostrap\Controller;
use Nhivonfq\Unlock\boostrap\Request;
use Nhivonfq\Unlock\Validation\RegisterValidate;

class AuthController extends Controller
{
    /**
     * @return array|false|string|string[]
     */
    public function login()
    {
        $this->setLayout('auth');

        return $this->render('login', []);
    }


    /**
     * @param Request $request
     * @return array|false|string|string[]
     */
    public function register(Request $request)
    {

        $registerValidate = new RegisterValidate();
        if ($request->isPost()) {

            $registerValidate->loadData($request->getBody());

            if ($registerValidate->validate() && $registerValidate->register()) {
                return 'Success';
            }

            return $this->render('register', ['model' => $registerValidate]);
        }

        $this->setLayout('auth');

        return $this->render('register', ['model' => $registerValidate]);

    }
}
