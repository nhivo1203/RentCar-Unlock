<?php

namespace Nhivonfq\Unlock\boostrap;
/**
 * Class Application
 * @package app\core
 */
class Application
{
    public Database $db;
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
    public function __construct($rootPath, array $config)
    {

        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->db = new Database($config['db']);
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

}
