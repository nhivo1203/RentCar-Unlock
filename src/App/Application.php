<?php

namespace Nhivonfq\Unlock\App;

use Exception;
use Nhivonfq\Unlock\Controllers\NotFoundController;
use Nhivonfq\Unlock\Database\Database;
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

    public const ROLE_INDEX = 1;


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
    public function __construct(string $rootPath)
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
    public function run(): void
    {
        Database::getConnection();

        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $container = new Container();

        $route = Router::$routes[$method][$path] ?? false;
        $aclAccept = $this->runAcl($route);
        if (!$aclAccept) {
            return;
        }
        if (!$route) {
            $controller = $container->make(NotFoundController::class);
            $action = 'notfound';
        } else {
            $callback = $route[0];
            $action = $callback[1];
            $controller = $container->make($callback[0]);
        }
        $response = $controller->{$action}();

        $this->view::display($response);
    }

    public static function isLogin(): bool
    {
        $container = new Container();
        return $container->make(SessionServices::class)->hasSession('user_id');
    }

    /**
     * @param bool|array $route
     * @return bool
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
            $message = $e->getMessage();
            if ($e instanceof UnauthenticatedException) {
                $this->isAPI() ?
                    $response = $this->response->toJson(['errors' => $message], Response::HTTP_UNAUTHENTIC)
                    :
                    $response = $this->response->redirect('/login');
            } else {
                $this->isAPI() ?
                    $response = $this->response->toJson(['errors' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED)
                    :
                    $response = $this->response->renderView('_403', ['errors' => $message]);
            }
            View::display($response, self::isLogin());
            return false;
        }

        return true;
    }
}
