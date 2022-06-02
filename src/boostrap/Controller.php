<?php

namespace Nhivonfq\Unlock\boostrap;

use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Transfer\RequestTransfer;

abstract class Controller
{
    protected Request $request;
    protected Response $response;
    protected RequestTransfer $requestTransfer;

    public function __construct(
        Request         $request,
        Response        $response,
        RequestTransfer $requestTransfer

    )
    {
        $this->request = $request;
        $this->response = $response;
        $this->requestTransfer = $requestTransfer;

    }
}
