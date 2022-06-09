<?php

namespace Nhivonfq\Unlock\Controllers\API;

use JsonException;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Models\User;
use Nhivonfq\Unlock\Request\LoginRequest;
use Nhivonfq\Unlock\Services\TokenServices;
use Nhivonfq\Unlock\Services\UserServices;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Transformer\UserTransformer;
use Nhivonfq\Unlock\Validate\LoginValidate;

class LoginAPIController
{
    private UserServices $loginServices;
    private LoginValidate $loginValidate;
    private Request $request;
    private Response $response;
    private TokenServices $tokenServices;
    private RequestTransfer $requestTransfer;
    private UserTransformer $userTransformer;


    public function __construct(
        LoginValidate   $loginValidate,
        Request         $request,
        Response        $response,
        UserServices    $loginServices,
        TokenServices   $tokenServices,
        RequestTransfer $requestTransfer,
        UserTransformer $userTransformer
    ) {
        $this->loginValidate = $loginValidate;
        $this->loginServices = $loginServices;
        $this->request = $request;
        $this->response = $response;
        $this->tokenServices = $tokenServices;
        $this->requestTransfer = $requestTransfer;
        $this->userTransformer = $userTransformer;
    }

    /**
     * @throws JsonException
     */
    public function login(): Response
    {
        if ($this->request->isGet()) {
            return $this->response->toJson(
                ['errors' => "Not Found"],
                Response::HTTP_NOT_FOUND
            );
        }
        $this->loginValidate->loadData($this->requestTransfer->getRequestJsonBody());
        if (!$this->loginValidate->validate()) {
            return $this->response->toJson(
                ['errors' => $this->loginValidate->getErrors()],
                Response::HTTP_BAD_REQUEST
            );
        }
        $user = $this->getUserData();
        if ($user === null) {
            return $this->response->toJson(
                ['errors' => "Email or Password is incorrect"],
                Response::HTTP_BAD_REQUEST
            );
        }
        $token = $this->tokenServices->generateToken($user);
        return $this->response->toJson([
            'data' => $this->userTransformer->toArray($user),
            "token" => $token
        ], Response::HTTP_OK);
    }

    /**
     * @throws JsonException
     */
    private function getUserData(): ?User
    {
        $loginRequest = new LoginRequest();
        $loginRequest = $loginRequest->fromArray($this->requestTransfer->getRequestJsonBody());
        return $this->loginServices->login($loginRequest);
    }
}
