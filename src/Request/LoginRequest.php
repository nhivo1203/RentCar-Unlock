<?php

namespace Nhivonfq\Unlock\Request;

use Exception;

class LoginRequest
{
    private string $email;
    private string $password;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->formatRequest($this->email);
    }

    /**
     * @param mixed|string $email
     */
    public function setEmail(mixed $email): void
    {
        $this->email = $this->formatRequest($email);
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

    /**
     * @param $data
     * @return string
     */
    private function formatRequest($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    public function fromArray(array $requestBody): self
    {
        $this->setEmail($requestBody['email']);
        $this->setPassword($requestBody['password']);
        return $this;
    }
}

