<?php

namespace Nhivonfq\Unlock\Services;

use Nhivonfq\Unlock\Repository\UserRepository;
use Nhivonfq\Unlock\Services\SessionServices;

class UserServices
{
    /**
     * @var string|mixed
     */
    public string $userClass;
    /**
     * @var SessionServices
     */
    public SessionServices $session;
    private ?UserRepository $user;

    public static UserServices $userServices;

    public function __construct(array $config)
    {
        self::$userServices = $this;
        $this->session = new SessionServices();
        $this->user = null;
        $this->userClass = $config['userClass'];

        $userId = $this->session->get('user');
        if ($userId) {
            $key = (new $this->userClass())::$primaryKey;
            $this->user = (new $this->userClass())->findOne([$key => $userId]);
        }
    }

    public static function isGuest()
    {
        return !self::$userServices->user;
    }


    public function login(UserRepository $user)
    {
        $this->user = $user;
        $primaryKey = $user::$primaryKey;
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);

        return true;
    }

    public function logout()
    {
        $this->user = null;
        self::$userServices->session->remove('user');
    }

}
