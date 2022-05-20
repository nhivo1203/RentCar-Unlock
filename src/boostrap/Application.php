<?php

namespace Nhivonfq\Unlock\boostrap;

use Nhivonfq\Unlock\App\View;
use Nhivonfq\Unlock\Database\Database;
use PDO;

/**
 * Class Application
 * @package app\core
 */
class Application
{
    public View $view;

    public ?DBModel $user;

    /**
     * @var string|mixed
     */
    public string $userClass;
    /**
     * @var PDO
     */
    public PDO $connection;
    /**
     * @var Session
     */
    public Session $session;

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

    public ?Controller $controller = null;

    /**
     * @param $rootPath
     */
    public function __construct($rootPath, array $config)
    {
        $this->user = null;
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->connection = new Database::getConnection();
        $this->session = new Session();
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();

        $userId = self::$app->session->get('user');
        if ($userId) {
            $key = (new $this->userClass())->primaryKey();
            $this->user = (new $this->userClass())->findOne([$key => $userId]);
        }
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }


    public function login(DBModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);

        return true;
    }

    public function logout()
    {
        $this->user = null;
        self::$app->session->remove('user');
    }


    /**
     * @return void
     */
    public function run()
    {
        echo $this->router->resolve();
    }

}
