<?php

namespace Nhivonfq\Unlock\boostrap;

use Nhivonfq\Unlock\App\View;
use function is_string;

class Router
{
    /**
     * @var
     */

    public Request $request;
    public Response $response;
    public View $view;

    protected array $routes = [];

    /**
     * @param Request $request
     */
    public function __construct(Request $request, Response $response)
    {
        $this->view = new View();
        $this->request = $request;
        $this->response = $response;
    }


    /**
     * @param $path
     * @param $callback
     * @return void
     */
    public function get($path, $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * @param $path
     * @param $callback
     * @return void
     */
    public function post($path, $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }


    /**
     * @return string
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();

        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            Application::$app->response->setStatusCode(404);
            return $this->view->renderView("_404");
        }
        if (is_string($callback)) {
            return $this->view->renderView($callback);
        }
        if (is_array($callback)) {
            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }

        return call_user_func($callback, $this->request, $this->response);
    }

    /**
     * @param int $a
     * @param $b
     * @return int
     */
    public function Sum(int $a, $b): int
    {
        return $a + $b;
    }

}
