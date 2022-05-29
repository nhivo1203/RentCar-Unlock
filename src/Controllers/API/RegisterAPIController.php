<?php

namespace Nhivonfq\Unlock\Controllers\API;

use JsonException;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Request\RegisterRequest;
use Nhivonfq\Unlock\Services\RegisterServices;
use Nhivonfq\Unlock\Services\TokenServices;
use Nhivonfq\Unlock\Validate\RegisterValidate;

class RegisterAPIController
{
    private RegisterServices $registerServices;
    private RegisterValidate $registerValidate;
    private Request $request;
    private Response $response;
    private TokenServices $tokenServices;


    public function __construct(
        RegisterValidate $registerValidate,
        Request       $request,
        Response      $response,
        RegisterServices $registerServices,
        TokenServices $tokenServices

    )
    {
        $this->registerValidate = $registerValidate;
        $this->registerServices = $registerServices;
        $this->request = $request;
        $this->response = $response;
        $this->tokenServices = $tokenServices;
    }

    private function generateToken($userTokenData): string
    {
        return $this->tokenServices->jwtEncodeData(
            $this->request->getHost() . $this->request->getRequestUri(),
            $userTokenData);
    }

    /**
     * @throws JsonException
     */
    public function register() {
        if (!$this->request->isPost()) {
            return $this->response->renderView('register');
        }
        $registerRequest = new RegisterRequest();
        $registerRequest = $registerRequest->fromArray($this->request->getRequestJsonBody());
        $this->registerValidate->loadData($this->request->getRequestJsonBody());
        $user = $this->registerServices->register($registerRequest);
        if (!$this->registerValidate->validate()) {
            return $this->response->toJson($this->registerValidate->errors, Response::HTTP_BAD_REQUEST);
        }
        if (!$user) {
            return $this->response->toJson(['message' => "Can not create user"], Response::HTTP_BAD_REQUEST);
        }
        $userTokenData = [
            'id' => $user->getId(),
            'email' => $user->getEmail()
        ];
        $data = $this->generateToken($userTokenData);
        return $this->response->toJson([
            'data' => [
                "user" => [
                    'firstname' => $user->getFirstname(),
                    'lastname' => $user->getLastname(),
                    'email' => $user->getEmail(),
                    'username' => $user->getUsername(),
                ],
                "token" => $data
            ]
        ], Response::HTTP_OK);

    }

}
