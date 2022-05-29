<?php

namespace Nhivonfq\Unlock\Request;

class RegisterRequest
{
    private int $id;
    private string $firstname;
    private string $lastname;
    private string $email ;
    private int $status = 0;
    private string $username ;
    private string $password ;

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

    /**
     * @param array $requestBody
     * @return $this
     */
    public function fromArray(array $requestBody): self
    {
        $this->setFirstname($requestBody['firstname']);
        $this->setLastname($requestBody['lastname']);
        $this->setEmail($requestBody['email']);
        $this->setUsername($requestBody['username']);
        $this->setPassword($requestBody['password']);
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

}
