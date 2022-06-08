<?php

namespace Nhivonfq\Unlock\Controllers;

use Nhivonfq\Unlock\App\View;
use Nhivonfq\Unlock\boostrap\Controller;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Repository\UserRepository;
use Nhivonfq\Unlock\Request\RegisterRequest;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Validate\RegisterValidate;


class RegisterController extends Controller
{
    private RegisterValidate $registerValidate;
    private UserRepository $userRepository;


    public function __construct(
        RegisterValidate $registerValidate,
        UserRepository   $userRepository,
        Request          $request,
        Response         $response,
        RequestTransfer  $requestTransfer

    )
    {
        parent::__construct($request, $response, $requestTransfer);
        $this->registerValidate = $registerValidate;
        $this->userRepository = $userRepository;
    }


    /**
     * @return Response
     */
    public function register(): Response
    {
        if ($this->request->isGet()) {
            return $this->response->renderView('register');
        }
        $this->registerValidate->loadData($this->requestTransfer->getRequestArrayBody());
        if ($this->registerValidate->validate()) {
            $registerRequest = new RegisterRequest();
            $userRequest = $registerRequest->fromArrayToModel($this->requestTransfer->getRequestArrayBody());
            if ($this->userRepository->saveUser($userRequest)) {
                View::redirect('/');
            }
        }
        return $this->response->renderView('register', ['errors' => $this->registerValidate->getErrors()]);
    }
}
