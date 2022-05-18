<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\Core\Application;
use Nhivonfq\Unlock\Core\Controller;
use Nhivonfq\Unlock\Core\Request;

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

        var_dump($body);
        die();

        return "Handling Submit Rent Car";
    }

    public function contact(): string
    {


        return $this->render('contact', []);
    }
}
