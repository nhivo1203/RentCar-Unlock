<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\boostrap\Controller;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Services\UserServices;

class SitesController extends Controller
{
    private Request $request;
    private Response $response;

    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
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

    public function logout()
    {
        if($this->request->isPost()) {
            UserServices::$userServices->logout();
            $this->response->redirect('/');
        }
        $this->response->redirect('/');
    }
}
