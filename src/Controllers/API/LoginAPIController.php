<?php

namespace Nhivonfq\Unlock\Controllers\API;

use JsonException;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Request\LoginRequest;
use Nhivonfq\Unlock\Services\LoginServices;
use Nhivonfq\Unlock\Services\TokenServices;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Validate\LoginValidate;


class LoginAPIController
{
    private LoginServices $loginServices;
    private LoginValidate $loginValidate;
    private Request $request;
    private Response $response;
    private TokenServices $tokenServices;
    private RequestTransfer $requestTransfer;


    public function __construct(LoginValidate   $loginValidate,
                                Request         $request,
                                Response        $response,
                                LoginServices   $loginServices,
                                TokenServices   $tokenServices,
                                RequestTransfer $requestTransfer
    )
    {
        $this->loginValidate = $loginValidate;
        $this->loginServices = $loginServices;
        $this->request = $request;
        $this->response = $response;
        $this->tokenServices = $tokenServices;
        $this->requestTransfer = $requestTransfer;
    }

    /**
     * @throws JsonException
     */
    public function login(): Response
    {
        if ($this->request->isPost()) {
            $loginRequest = new LoginRequest();
            $loginRequest = $loginRequest->fromArray($this->requestTransfer->getRequestJsonBody());
            $this->loginValidate->loadData($this->requestTransfer->getRequestJsonBody());
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
            $data = $this->tokenServices->jwtEncodeData(
                $this->request->getHost() . $this->request->getRequestUri(),
                $userTokenData);
            return $this->response->toJson([
                'data' => [
                    "email" => $user->getEmail(),
                    "token" => $data
                ]
            ], Response::HTTP_OK);
        }
        return $this->response->renderView('login');
    }

}
