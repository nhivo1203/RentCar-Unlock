<?php

namespace Nhivonfq\Tests\Controllers;

use Nhivonfq\Unlock\Controllers\HomeController;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use PHPUnit\Framework\TestCase;

class HomeControllerTest extends TestCase
{
    public function testHomeRenderView() {
        $request = new Request();
        $response = new Response();

        $homeController = new HomeController($request, $response);
        $homeController = $homeController->home();

        $expectedResult = new Response();
        $expectedResult->setTemplate('home');

        $this->assertEquals($expectedResult, $homeController);
    }
}
