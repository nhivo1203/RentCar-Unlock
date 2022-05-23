<?php

namespace Nhivonfq\Unlock\Validate;

use Nhivonfq\Unlock\boostrap\Validate;
use Nhivonfq\Unlock\Repository\UserRepository;
use Nhivonfq\Unlock\Services\UserServices;

class LoginValidate extends Validate
{
    public $user;
    public UserRepository $userRepository;

    public string $email = '';
    public string $password = '';


    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function handleLogin()
    {
        $this->user = $this->userRepository->findOne(['email' => $this->email]);
        if (!$this->user) {
            $this->addError('email', 'User does not exits');
            return false;
        }
        if (password_verify(password_hash($this->password,PASSWORD_DEFAULT), $this->user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }


        return true;
    }

}
