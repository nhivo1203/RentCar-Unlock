<?php

namespace Nhivonfq\Unlock\Services;

use Nhivonfq\Unlock\Repository\UserRepository;
use Nhivonfq\Unlock\Request\LoginRequest;

class LoginServices
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


    public static function isGuest(): bool
    {
        $session = new SessionServices();
        return !$session->hasSession('user_id');
    }


    public function login(LoginRequest $loginRequest): bool
    {
        $exitUser = $this->userRepository->findOne(['email' => $loginRequest->getEmail()]);
        if ($exitUser && password_verify($loginRequest->getPassword(), $exitUser->getPassword())) {
            $this->session->set('user_id', $exitUser->getId());
            return true;
        }

        return false;
    }

    public function logout()
    {
        $this->session->remove('user_id');
    }

}