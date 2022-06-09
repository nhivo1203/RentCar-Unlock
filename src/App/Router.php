<?php

namespace Nhivonfq\Unlock\App;

use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Models\User;

class Router
{
    /**
     * @var
     */

    public Request $request;
    public Response $response;

    public static array $routes = [];

    /**
     * @param Request $request
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    /**
     * @param string $path
     * @param array $callback
     * @param int $role
     * @return void
     */
    public static function get(string $path, array $callback, int $role = User::ROLE_GUEST): void
    {
        self::$routes['get'][$path] = [$callback, $role];
    }

    /**
     * @param string $path
     * @param array $callback
     * @param int $role
     * @return void
     */
    public static function post(string $path, array $callback, int $role = User::ROLE_GUEST): void
    {
        self::$routes['post'][$path] = [$callback, $role];
    }
}
