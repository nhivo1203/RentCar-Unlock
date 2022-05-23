<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\boostrap\Controller;
use Nhivonfq\Unlock\boostrap\Request;
use Nhivonfq\Unlock\boostrap\Response;
use Nhivonfq\Unlock\Services\UserServices;

class SitesController extends Controller
{
    public function home(): string
    {
        $params = [
            'name' => 'Nhi Vo'
        ];

        return $this->render('home',$params);
    }


    public function handleRentCar(Request $request): string
    {
        $body = $request->getBody();

        return "Handling Submit Rent Car";
    }

    public function contact(): string
    {
        return $this->render('contact', []);
    }

    public function logout(Request $request, Response $response)
    {
        UserServices::$userServices->logout();
        $response->redirect('/');
    }
}
