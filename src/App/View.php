<?php

namespace Nhivonfq\Unlock\App;

class View
{
    public static function display($response)
    {
        if($response->getRedirectUrl() !== null)
        {
            static::redirect($response->getRedirectUrl());
        }
        $template = $response->getTemplate();
        $data = $response->getData();

        require __DIR__ . "/../Views/layouts/main.php";
        require __DIR__ . "/../Views/$template.php";
    }

    public static function redirect($url)
    {
        header("Location: $url");
    }
}
