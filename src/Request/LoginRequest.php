<?php

namespace Nhivonfq\Unlock\Request;

class LoginRequest
{
    private string $email = '';
    private string $password = '';
    

    public function fromArray(array $requestBody): self
    {
        $this->setEmail($requestBody['email']);
        $this->setPassword($requestBody['password']);
        return $this;
    }
    
    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param mixed|string $email
     */
    public function setEmail(mixed $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param mixed|string $password
     */
    public function setPassword(mixed $password): void
    {
        $this->password = $password;
    }
}

