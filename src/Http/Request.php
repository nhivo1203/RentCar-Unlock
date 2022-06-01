<?php

namespace Nhivonfq\Unlock\Http;

class Request
{
    public function getPath()
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

    public function isPost()
    {
        return $this->getMethod() === 'post';
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $_SERVER['HTTP_AUTHORIZATION'] ?? null;
    }
}
