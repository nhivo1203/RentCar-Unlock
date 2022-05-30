<?php

namespace Nhivonfq\Unlock\Controllers;

use JsonException;
use Nhivonfq\Unlock\App\View;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Request\CreateCarRequest;
use Nhivonfq\Unlock\Services\CreateCarServices;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Validate\CreateCarValidate;

class CreateCarController
{
    private Request $request;
    private Response $response;
    private RequestTransfer $requestTransfer;
    private CreateCarValidate $createCarValidate;
    private CreateCarServices $createCarServices;

    public function __construct(Request $request,
                                Response $response,
                                RequestTransfer $requestTransfer,
                                CreateCarValidate $createCarValidate,
                                CreateCarServices $createCarServices)
    {
        $this->request = $request;
        $this->response = $response;
        $this->requestTransfer = $requestTransfer;
        $this->createCarValidate = $createCarValidate;
        $this->createCarServices = $createCarServices;
    }


    public function createCar():Response {
        if($this->request->isPost()) {
            $createCarRequest = new CreateCarRequest();
            $createCarRequest = $createCarRequest->fromArray($this->requestTransfer->getBody());
            $this->createCarValidate->loadData($this->requestTransfer->getBody());
            if($this->createCarValidate->validate() && $this->createCarServices->createCar($createCarRequest)){
                View::redirect('/');
            }
            return $this->response->renderView('createcar',['errors' => $this->createCarValidate]);
        }
        return $this->response->renderView('createcar',['errors' => $this->createCarValidate]);
    }
}
