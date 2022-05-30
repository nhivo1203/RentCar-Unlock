<?php

namespace Nhivonfq\Unlock\Services;

use Nhivonfq\Unlock\Models\UserModel;
use Nhivonfq\Unlock\Repository\UserRepository;
use Nhivonfq\Unlock\Request\RegisterRequest;

class RegisterServices
{
    private ?UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $registerRequest): UserModel| bool
    {
        $user = new UserModel();
        $user->setFirstname($registerRequest->getFirstname());
        $user->setLastname($registerRequest->getLastname());
        $user->setEmail($registerRequest->getEmail());
        $user->setRole($registerRequest->getRole());
        $user->setUsername($registerRequest->getUsername());
        $password = password_hash($registerRequest->getPassword(), PASSWORD_DEFAULT);
        $user->setPassword($password);

        $this->userRepository->saveUser($user);
        return $user;
    }
}
