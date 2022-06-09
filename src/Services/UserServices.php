<?php

namespace Nhivonfq\Unlock\Services;

use Nhivonfq\Unlock\Models\User;
use Nhivonfq\Unlock\Repository\UserRepository;
use Nhivonfq\Unlock\Request\LoginRequest;

class UserServices
{
    /**
     * @var SessionServices
     */
    public SessionServices $session;
    private ?UserRepository $userRepository;

    public function __construct(UserRepository $userRepository, SessionServices $session)
    {
        $this->session = $session;
        $this->userRepository = $userRepository;
    }

    public function login(LoginRequest $loginRequest): ?User
    {
        $exitUser = $this->userRepository->findOne(['email' => $loginRequest->getEmail()]);
        if ($exitUser && password_verify($loginRequest->getPassword(), $exitUser->getPassword())) {
            $this->session->set('user_id', $exitUser->getId());
            return $exitUser;
        }
        return null;
    }

    public function logout():void
    {
        $this->session->remove('user_id');
    }

}
