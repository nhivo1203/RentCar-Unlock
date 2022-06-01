<?php

namespace Nhivonfq\Unlock\Services;

use Nhivonfq\Unlock\Models\UserModel;
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


    public static function isLogin(): bool
    {
        $session = new SessionServices();
        return !$session->hasSession('user_id');
    }


    public function login(LoginRequest $loginRequest): UserModel| bool
    {
        $exitUser = $this->userRepository->findOne(['email' => $loginRequest->getEmail()]);
        if ($exitUser && password_verify($loginRequest->getPassword(), $exitUser->getPassword())) {
            $this->session->set('user_id', $exitUser->getId());
            return $exitUser;
        }

        return false;
    }

    public function logout():void
    {
        $this->session->remove('user_id');
    }

}
