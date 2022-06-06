<?php

namespace Nhivonfq\Unlock\boostrap;

use Nhivonfq\Unlock\App\View;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Models\UserModel;
use function is_string;

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
    public static function get(string $path, array $callback, int $role = UserModel::ROLE_GUEST): void
    {
        self::$routes['get'][$path] = [$callback, $role];
    }

    /**
     * @param string $path
     * @param array $callback
     * @param int $role
     * @return void
     */
    public static function post(string $path, array $callback, int $role = UserModel::ROLE_GUEST): void
    {
        self::$routes['post'][$path] = [$callback, $role];
    }
}
