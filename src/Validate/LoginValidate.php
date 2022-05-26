<?php

namespace Nhivonfq\Unlock\Validate;

use Nhivonfq\Unlock\boostrap\Validate;
use Nhivonfq\Unlock\Models\UserModel;
use Nhivonfq\Unlock\Repository\UserRepository;

class LoginValidate extends Validate
{
    public UserModel $user;
    public UserRepository $userRepository;

    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }
}
