<?php

namespace Nhivonfq\Unlock\Controllers\API;

use JsonException;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Request\LoginRequest;
use Nhivonfq\Unlock\Services\UserServices;
use Nhivonfq\Unlock\Services\TokenServices;
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


    public function __construct(LoginValidate   $loginValidate,
                                Request         $request,
                                Response        $response,
                                UserServices    $loginServices,
                                TokenServices   $tokenServices,
                                RequestTransfer $requestTransfer,
                                UserTransformer $userTransformer
    )
    {
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
            return $this->response->renderView('login', ['errors' => $this->loginValidate]);
        }
        $this->loginValidate->loadData($this->requestTransfer->getRequestJsonBody());
        if (!$this->loginValidate->validate()) {
            return $this->response->toJson($this->loginValidate->errors, Response::HTTP_BAD_REQUEST);
        }
        $loginRequest = new LoginRequest();
        $loginRequest = $loginRequest->fromArray($this->requestTransfer->getRequestJsonBody());
        $user = $this->loginServices->login($loginRequest);
        if (!$user) {
            return $this->response->toJson(['message' => "Username or password is incorrect"], Response::HTTP_UNAUTHEN);
        }
        $userTokenData = [
            'id' => $user->getId(),
            'email' => $user->getEmail()
        ];
        $token = $this->tokenServices->jwtEncodeData($userTokenData);
        return $this->response->toJson([
            'data' => $this->userTransformer->toArray($user),
            "token" => $token
        ], Response::HTTP_OK);

    }

}
