<?php

namespace Nhivonfq\Unlock\Validation;

use Nhivonfq\Unlock\boostrap\Application;
use Nhivonfq\Unlock\boostrap\Validate;

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

    public function login()
    {
        $user = (new UserValidate)->findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'User does not exits');
            return false;
        }
        if (password_verify(password_hash($this->password,PASSWORD_DEFAULT), $user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }


        return Application::$app->login($user);
    }

}
