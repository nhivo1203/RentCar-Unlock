<?php

namespace Nhivonfq\Unlock\Core;
/**
 * Class Application
 * @package app\core
 */
class Application
{
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

        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request);
    }



    /**
     * @return void
     */
    public function run()
    {
        echo $this->router->resolve();
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
}