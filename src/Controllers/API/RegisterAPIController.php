<?php

namespace Nhivonfq\Unlock\Controllers\API;

use JsonException;
use Nhivonfq\Unlock\App\Controller;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Models\User;
use Nhivonfq\Unlock\Repository\UserRepository;
use Nhivonfq\Unlock\Request\RegisterRequest;
use Nhivonfq\Unlock\Services\TokenServices;
use Nhivonfq\Unlock\Transfer\RequestTransfer;
use Nhivonfq\Unlock\Transformer\UserTransformer;
use Nhivonfq\Unlock\Validate\RegisterValidate;

class RegisterAPIController extends Controller
{
    private RegisterValidate $registerValidate;
    private TokenServices $tokenServices;
    private UserTransformer $userTransformer;
    private UserRepository $userRepository;


    public function __construct(
        RegisterValidate $registerValidate,
        Request          $request,
        Response         $response,
        TokenServices    $tokenServices,
        RequestTransfer  $requestTransfer,
        UserTransformer  $userTransformer,
        UserRepository   $userRepository
    ) {
        parent::__construct($request, $response, $requestTransfer);
        $this->registerValidate = $registerValidate;
        $this->tokenServices = $tokenServices;
        $this->userTransformer = $userTransformer;
        $this->userRepository = $userRepository;
    }


    /**
     * @throws JsonException
     */
    public function register(): Response
    {
        if ($this->request->isGet()) {
            return $this->response->toJson(
                ['errors' => "Not Found"],
                Response::HTTP_NOT_FOUND
            );
        }
        $this->registerValidate->loadData($this->requestTransfer->getRequestJsonBody());
        if (!$this->registerValidate->validate()) {
            return $this->response->toJson(
                ['errors' => $this->registerValidate->getErrors()],
                Response::HTTP_BAD_REQUEST
            );
        }
        $user = $this->isRegister();
        if ($user=== null) {
            return $this->response->toJson(
                ['errors' => 'Can create user'],
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
    private function isRegister(): ?User
    {
        $registerRequest = new RegisterRequest();
        $userRequest = $registerRequest->fromArrayToModel($this->requestTransfer->getRequestJsonBody());
        $user = $this->userRepository->saveUser($userRequest);
        if (!$user) {
            return null;
        }
        return $user;
    }
}
