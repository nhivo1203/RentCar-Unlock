<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\App\View;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Request\RegisterRequest;
use Nhivonfq\Unlock\Services\RegisterServices;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Validate\RegisterValidate;


class RegisterController
{
    private RegisterValidate $registerValidate;
    private RegisterServices $registerServices;
    private Request $request;
    private Response $response;
    private RequestTransfer $requestTransfer;

    public function __construct(
        RegisterValidate $registerValidate,
        Request          $request,
        Response         $response,
        RegisterServices $registerServices,
        RequestTransfer  $requestTransfer

    )
    {
        $this->registerValidate = $registerValidate;
        $this->registerServices = $registerServices;
        $this->request = $request;
        $this->response = $response;
        $this->requestTransfer = $requestTransfer;
    }


    /**
     * @return Response
     */
    public function register(): Response
    {
        if ($this->request->isPost()) {
            $registerRequest = new RegisterRequest();
            $registerRequest = $registerRequest->fromArray($this->requestTransfer->getBody());
            $this->registerValidate->loadData($this->requestTransfer->getBody());
            if ($this->registerValidate->validate()
                && $this->registerServices->register($registerRequest)
            ) {
                View::redirect('/');
            }

            return $this->response->renderView('register',['errors' => $this->registerValidate]);
        }

        return $this->response->renderView('register',['errors' => $this->registerValidate]);
    }


}
