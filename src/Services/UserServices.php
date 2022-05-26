<?php

namespace Nhivonfq\Unlock\Services;

use Nhivonfq\Unlock\Models\UserModel;
use Nhivonfq\Unlock\Repository\UserRepository;
use Nhivonfq\Unlock\Request\LoginRequest;

class UserServices
{
    /**
     * @var SessionServices
     */
    public SessionServices $session;
    private ?UserRepository $userRepository;
    private static ?UserModel $exitUser = null;

    public UserServices $userServices;

    public function __construct(UserRepository $userRepository, UserModel $user, SessionServices $session)
    {
        $this->userRepository = $userRepository;
        $this->$user = $user;
        $this->$session = $session;
    }

    public static function isGuest(): bool
    {
        return !self::$exitUser;
    }


    public function login(LoginRequest $loginRequest): ?UserModel
    {
        self::$exitUser = $this->userRepository->findOne(['email' => $loginRequest->getEmail()]);
        if (!self::$exitUser) {
            return null;
        }
        if (password_verify(password_hash($loginRequest->getPassword(), PASSWORD_DEFAULT), self::$exitUser->password)) {
            return null;
        }
        return self::$exitUser;
//        $this->user = $user;
//        $primaryKey = $user::$primaryKey;
//        $primaryValue = $user->{$primaryKey};
//        $this->session->set('user', $primaryValue);
//
//        return true;
    }

    public function logout()
    {
        $this->user = null;
        self::$userServices->session->remove('user');
    }

}
