<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\Core\Application;

class SitesController
{
    public function handleRentCar():string
    {
        return Application::$app->router->renderView('contact');
    }

    public function contact():string
    {
        return "handling Rent Car";
    }
}
