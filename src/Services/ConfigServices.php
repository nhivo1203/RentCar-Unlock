<?php

namespace Nhivonfq\Unlock\Services;

use Dotenv\Dotenv;

class ConfigServices
{
    public static function run(): void
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
    }
}
