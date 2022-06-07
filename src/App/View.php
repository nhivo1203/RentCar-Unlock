<?php

namespace Nhivonfq\Unlock\App;

use Nhivonfq\Unlock\Http\Response;

class View
{
    /**
     * @param $response
     * @return void
     */
    public static function display($response, bool $isLogin = false): void
    {
        if ($response->getRedirectUrl() !== null) {
            static::renderRedirect($response);
            return;
        }

        if ($response->getTemplate() !== null) {
            static::renderView($response, $isLogin);
            return;
        }

        static::renderJson($response);

        exit();
    }


    public static function renderView(Response $response, bool $isLogin = false): void
    {
        $template = $response->getTemplate();
        $data = $response->getData();
        if ($data === null) {
            $data = [];
        }

        $data = [
            ...$data,
            'isLogin' => $isLogin
        ];
        $_SESSION['token'] = md5(uniqid(mt_rand(), true));
        require __DIR__ . "/../Views/layouts/main.php";
        require __DIR__ . "/../Views/$template.php";
    }

    public static function renderJson(Response $response): void
    {
        $data = $response->getData();
        $statusCode = $response->getStatusCode();
        $dataResponse = json_encode($data);
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($statusCode);
        print_r($dataResponse);
    }

    public static function renderRedirect(Response $response): void
    {
        static::redirect($response->getRedirectUrl());
    }

    public static function redirect($url): void
    {
        header("Location: $url");
    }
}
