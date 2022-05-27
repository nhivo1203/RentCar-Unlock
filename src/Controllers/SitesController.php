<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\boostrap\Controller;
use Nhivonfq\Unlock\Http\Response;

class SitesController extends Controller
{
    private Response $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }


    public function contact(): Response
    {
        return $this->response->renderView('contact');
    }

}
