<?php

namespace Nhivonfq\Unlock\Controllers\API;

use JsonException;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Models\UserModel;
use Nhivonfq\Unlock\Request\LoginRequest;
use Nhivonfq\Unlock\Services\LoginServices;
use Nhivonfq\Unlock\Services\TokenServices;
use Nhivonfq\Unlock\Validate\LoginValidate;


class LoginAPIController
{
    private LoginServices $loginServices;
    private LoginValidate $loginValidate;
    private Request $request;
    private Response $response;
    private TokenServices $tokenServices;


    public function __construct(
        LoginValidate $loginValidate,
        Request       $request,
        Response      $response,
        LoginServices $loginServices,
        TokenServices $tokenServices

    )
    {
        $this->loginValidate = $loginValidate;
        $this->loginServices = $loginServices;
        $this->request = $request;
        $this->response = $response;
        $this->tokenServices = $tokenServices;
    }

    public function loginHasError()
    {
        if (!$this->loginValidate->validate()) {
            return $this->response->toJson($this->loginValidate->errors, Response::HTTP_BAD_REQUEST);
        }
    }

    public function loginHasUser($user)
    {
        if (!$user) {
            return $this->response->toJson(['message' => "Username or password is incorrect"], Response::HTTP_UNAUTHEN);
        }
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
    public function login()
    {
        if (!$this->request->isPost()) {
            return $this->response->renderView('login');
        }
        $loginRequest = new LoginRequest();
        $loginRequest = $loginRequest->fromArray($this->request->getRequestJsonBody());
        $this->loginValidate->loadData($this->request->getRequestJsonBody());
        $user = $this->loginServices->login($loginRequest);
        if (!$this->loginValidate->validate()) {
            return $this->response->toJson($this->loginValidate->errors, Response::HTTP_BAD_REQUEST);
        }
        if (!$user) {
            return $this->response->toJson(['message' => "Username or password is incorrect"], Response::HTTP_UNAUTHEN);
        }
        $userTokenData = [
            'id' => $user->getId(),
            'email' => $user->getEmail()
        ];
        $data = $this->generateToken($userTokenData);
        return $this->response->toJson([
            'data' => [
                "email" => $user->getEmail(),
                "token" => $data
            ]
        ], Response::HTTP_OK);
    }

}
