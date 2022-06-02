<?php

namespace Nhivonfq\Unlock\Controllers\API;

use JsonException;
use Nhivonfq\Unlock\boostrap\Controller;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Request\RegisterRequest;
use Nhivonfq\Unlock\Services\RegisterServices;
use Nhivonfq\Unlock\Services\TokenServices;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Transformer\UserTransformer;
use Nhivonfq\Unlock\Validate\RegisterValidate;

class RegisterAPIController extends Controller
{
    private RegisterServices $registerServices;
    private RegisterValidate $registerValidate;
    private TokenServices $tokenServices;
    private UserTransformer $userTransformer;


    public function __construct(
        RegisterValidate $registerValidate,
        Request          $request,
        Response         $response,
        RegisterServices $registerServices,
        TokenServices    $tokenServices,
        RequestTransfer $requestTransfer,
        UserTransformer $userTransformer

    )
    {
        parent::__construct($request, $response, $requestTransfer);
        $this->registerValidate = $registerValidate;
        $this->registerServices = $registerServices;
        $this->tokenServices = $tokenServices;
        $this->userTransformer = $userTransformer;

    }

    /**
     * @throws JsonException
     */
    public function register(): Response
    {
        if ($this->request->isPost()) {
            $registerRequest = new RegisterRequest();
            $registerRequest = $registerRequest->fromArray($this->requestTransfer->getRequestJsonBody());
            $this->registerValidate->loadData($this->requestTransfer->getRequestJsonBody());
            if (!$this->registerValidate->validate()) {
                return $this->response->toJson($this->registerValidate->errors, Response::HTTP_BAD_REQUEST);
            }

            $user = $this->registerServices->register($registerRequest);

            if (!$user) {
                return $this->response->toJson(['message' => "Can not create user"], Response::HTTP_BAD_REQUEST);
            }
            $userTokenData = [
                'id' => $user->getId(),
                'email' => $user->getEmail()
            ];
            $token = $this->tokenServices->jwtEncodeData($userTokenData);
            return $this->response->toJson([
                'data' => [
                    "user" => $this->userTransformer->toArray($user),
                    "token" => $token
                ]
            ], Response::HTTP_OK);
        }
        return $this->response->renderView('register');
    }

}
