<?php

namespace Nhivonfq\Unlock\Http;

class Request
{
    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if ($position === false) {
            return $path;
        }

        return substr($path, 0, $position);
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $_SERVER['HTTP_HOST'];
    }

    /**
     * @return string
     */
    public function getRequestUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return $this->getMethod() === 'post';
    }

    /**
     * @return bool
     */
    public function isGet(): bool
    {
        return $this->getMethod() === 'get';
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $_SERVER['HTTP_AUTHORIZATION'] ?? null;
    }

    public function getFiles():array {
        return $_FILES;
    }
}
