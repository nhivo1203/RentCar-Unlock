<?php

namespace Nhivonfq\Unlock\Services;

class SessionServices
{

    public function set(string $key, int $value):void
    {
        $_SESSION[$key] = $value;
    }

    public function hasSession(string $key):bool
    {
        return isset($_SESSION[$key]);
    }

    public function get($key): mixed
    {
        return $_SESSION[$key] ?: false;
    }

    public function remove($key):void
    {
        unset($_SESSION[$key]);
    }
}
