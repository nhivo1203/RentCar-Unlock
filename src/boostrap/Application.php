<?php

namespace Nhivonfq\Unlock\boostrap;

use Exception;
use Nhivonfq\Unlock\App\View;
use Nhivonfq\Unlock\Exception\UnauthenticatedException;
use Nhivonfq\Unlock\Http\Request;
use Nhivonfq\Unlock\Http\Response;
use Nhivonfq\Unlock\Services\SessionServices;

/**
 * Class Application
 * @package app\core
 */
class Application
{

    const ROLE_INDEX = 1;


    /**
     * @var View|mixed|object
     */
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

    public ACL $acl;

    /**
     * @var Application
     */
    public static Application $app;


    /**
     * @param $rootPath
     */
    public function __construct($rootPath)
    {
        $container = new Container();
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = $container->make(Request::class);
        $this->response = $container->make(Response::class);
        $this->router = $container->make(Router::class);
        $this->view = $container->make(View::class);
        $this->acl = $container->make(ACL::class);
    }

    /**
     * @return bool
     */
    private function isAPI(): bool
    {
        $path = $this->request->getPath();
        return str_starts_with($path, '/api');
    }

    /**
     * @return void
     */
    public function run()
    {

        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $container = new Container();

        $route = $this->router->routes[$method][$path] ?? false;

        $aclAccept = $this->runAcl($route);
        if (!$aclAccept) {
            return;
        }
        $callback = $route[0];
        if (!$callback) {
            $this->response->setStatusCode(404);
            $response = $this->response->renderView("_404");
            $this->view::display($response);
        }
        if (is_string($callback)) {
            $this->view::display($route);
        }
        $action = $callback[1];
        $controller = $container->make($callback[0]);
        $response = $controller->{$action}();

        $this->view::display($response);
    }


    /**
     * @param bool|array $route
     * @return bool
     * @throws ReflectionException
     */
    private function runAcl(bool|array $route): bool
    {
        if (!$route) {
            return true;
        }
        $role = $route[static::ROLE_INDEX];

        if ($role === 0) {
            return true;
        }

        try {
            $aclAccept = $this->acl->checkCanAccess($route[static::ROLE_INDEX]);
        } catch (Exception $e) {
            $statusCode = $e->getCode();
            $message = $e->getMessage();
            if ($e instanceof UnauthenticatedException) {
                if ($this->isAPI()) {
                    $response = $this->response->toJson(['message' => $message], Response::HTTP_BAD_REQUEST);
                } else {
                    $response = $this->response->redirect('/login');
                }
            } else {
                $response = $this->response->renderView('_403', ['message' => $message]);
            }
            View::display($response, $this->isLogin());
            return false;
        }

        return true;
    }

    private function isLogin(): bool
    {
        $container = new Container();
        $sessionServices = $container->make(SessionServices::class);;
        return $sessionServices->hasSession('user_id');
    }
}
