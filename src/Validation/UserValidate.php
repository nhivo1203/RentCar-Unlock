<?php

namespace Nhivonfq\Unlock\Validation;

use Nhivonfq\Unlock\boostrap\DBModel;
use Nhivonfq\Unlock\boostrap\Validate;

class UserValidate extends DBModel
{
    const STATUS_INACTIVE=0;
    const STATUS_ACTIVE=1;
    const STATUS_DELETED=2;

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public int $status = self::STATUS_INACTIVE;
    public string $username = '';
    public string $password = '';
    public string $confirmPassword = '';


    public function tableName(): string
    {
        return 'users';
    }


    public function primaryKey(): string
    {
        return 'id';
    }

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'password', 'status', 'username'];
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

    public function register()
    {
        $this->password = password_hash($this->password,PASSWORD_DEFAULT);
        return $this->save();
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
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match'=> 'password']],
        ];
    }

    public function getDisplayName(): string
    {
        return $this->firstname. " " . $this->lastname;
    }
}
