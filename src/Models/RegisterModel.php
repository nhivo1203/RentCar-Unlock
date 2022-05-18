<?php

namespace Nhivonfq\Unlock\Models;

use Nhivonfq\Unlock\Core\Model;

class RegisterModel extends Model
{
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $username;
    public string $password;
    public string $Confirmpassword;

    public function register(): string
    {
        return "Creating new user";
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'username' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 50]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6], [self::RULE_MAX, 'max' => 50]],
            'Confirmpassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match'=> 'password']],
        ];
    }
}
