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

    public array $routes = [];

    /**
     * @param Request $request
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    /**
     * @param $path
     * @param $callback
     * @return void
     */
    public function get($path, $callback, int $role = UserModel::ROLE_GUEST): void
    {
        $this->routes['get'][$path] = [$callback, $role];
    }

    /**
     * @param $path
     * @param $callback
     * @return void
     */
    public function post($path, $callback, int $role = UserModel::ROLE_GUEST): void
    {
        $this->routes['post'][$path] = [$callback, $role];
    }
}
