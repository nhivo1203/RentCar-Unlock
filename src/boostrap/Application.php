<?php

namespace Nhivonfq\Unlock\boostrap;

use Nhivonfq\Unlock\App\View;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;

/**
 * Class Application
 * @package app\core
 */
class Application
{
    public View $view;

    /**
     * @var string
     */
    public static string $ROOT_DIR;
    /**
     * @var Router
     */
    public Router $router;
    /**
     * @var Request
     */
    public Request $request;

    /**
     * @var Response
     */
    public Response $response;
    /**
     * @var Application
     */
    public static Application $app;

    public Controller $controller;

    /**
     * @param $rootPath
     */
    public function __construct($rootPath)
    {
        $container = new Container();
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->controller = $container->make(Controller::class);
        $this->request = $container->make(Request::class);
        $this->response = $container->make(Response::class);
        $this->router = $container->make(Router::class);
        $this->view = $container->make(View::class);
    }

    /**
     * @return void
     */
    public function run()
    {

        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $container = new Container();

        $callback = $this->router->routes[$method][$path] ?? false;
        if ($callback === false) {
            $this->response->setStatusCode(404);
            $response = $this->response->renderView("_404");
            $this->view::display($response);
        }
        if (is_string($callback)) {
            $this->view::display($callback);
        }
        $action = $callback[1];
        $controller = $container->make($callback[0]);
        $response = $controller->{$action}();

        $this->view::display($response);
    }
}
