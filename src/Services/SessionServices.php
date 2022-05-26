<?php

namespace Nhivonfq\Unlock\Services;

class SessionServices
{

    public function set($key, $value):void
    {
        $_SESSION[$key] = $value;
    }

    public function hasSession($key):bool
    {
        return isset($_SESSION[$key]) ? true : false;
    }

    public function get($key):bool
    {
        return $_SESSION[$key] ?? false;
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }
}
