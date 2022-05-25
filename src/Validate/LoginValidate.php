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
}
