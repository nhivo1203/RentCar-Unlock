<?php

namespace Nhivonfq\Unlock\Validate;

use Nhivonfq\Unlock\App\Validate;


class LoginValidate extends Validate
{

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
