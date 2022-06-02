<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\App\View;
use Nhivonfq\Unlock\boostrap\Controller;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Request\RegisterRequest;
use Nhivonfq\Unlock\Services\RegisterServices;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Validate\RegisterValidate;


class RegisterController extends Controller
{
    private RegisterValidate $registerValidate;
    private RegisterServices $registerServices;


    public function __construct(
        RegisterValidate $registerValidate,
        Request          $request,
        Response         $response,
        RegisterServices $registerServices,
        RequestTransfer  $requestTransfer

    )
    {
        parent::__construct($request, $response, $requestTransfer);
        $this->registerValidate = $registerValidate;
        $this->registerServices = $registerServices;
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
