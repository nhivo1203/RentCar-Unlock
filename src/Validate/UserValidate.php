<?php

namespace Nhivonfq\Unlock\Validate;

use Nhivonfq\Unlock\boostrap\Validate;
use Nhivonfq\Unlock\Models\User;
use Nhivonfq\Unlock\Repository\UserRepository;

class UserValidate extends Validate
{
    public User $user;
    public UserRepository $userRepository;

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


    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->user = new User();
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
        $this->user->setFirstname($this->firstname);
        $this->user->setLastname($this->lastname);
        $this->user->setEmail($this->email);
        $this->user->setStatus($this->status);
        $this->user->setUsername($this->username);
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->user->setPassword($this->password);

        return $this->userRepository->save($this->user);
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
