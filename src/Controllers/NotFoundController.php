<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\Http\Response;

class NotFoundController
{
    private Response $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }


    public function notfound(): Response
    {
        return $this->response->renderView('_404',[]);
    }
}
