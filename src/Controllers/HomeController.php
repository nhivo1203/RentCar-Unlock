<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;

class HomeController
{
    protected Response $response;
    protected Request $request;

    public function __construct(Request $request, Response $response){
        $this->response = $response;
        $this->request = $request;
    }

    public function home(): Response
    {
        return $this->response->renderView('home');
    }
}
