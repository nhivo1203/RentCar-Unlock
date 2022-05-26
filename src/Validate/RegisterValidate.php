<?php

namespace Nhivonfq\Unlock\Validate;

use Nhivonfq\Unlock\boostrap\Validate;
use Nhivonfq\Unlock\Models\UserModel;

class RegisterValidate extends Validate
{
    public UserModel $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }


    public function labels(): array
    {
        return [
            'firstname' => 'First name',
            'lastname' => 'Last name',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'confirmPassword' => 'Password Confirm'
        ];
    }


    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'username' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 50]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 50]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function getDisplayName(): string
    {
        return $this->firstname . " " . $this->lastname;
    }
}
