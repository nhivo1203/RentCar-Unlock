<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\boostrap\Application;
use Nhivonfq\Unlock\boostrap\Controller;
use Nhivonfq\Unlock\boostrap\Request;

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
