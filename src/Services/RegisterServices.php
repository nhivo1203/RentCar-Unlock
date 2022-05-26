<?php

namespace Nhivonfq\Unlock\Services;

use Nhivonfq\Unlock\Models\UserModel;
use Nhivonfq\Unlock\Request\LoginRequest;

class RegisterServices
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;


    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public int $status = self::STATUS_INACTIVE;
    public string $username = '';
    public string $password = '';
    public string $confirmPassword = '';


    public function register(LoginRequest $loginRequest): ?UserModel
    {
        $user = new UserModel();
        $user->setFirstname($this->firstname);
        $user->setLastname($this->lastname);
        $user->setEmail($this->email);
        $user->setStatus($this->status);
        $user->setUsername($this->username);
        $password = password_hash($this->password, PASSWORD_DEFAULT);
        $user->setPassword($password);

        return $user;
    }
}
