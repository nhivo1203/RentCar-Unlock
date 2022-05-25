<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use Nhivonfq\Unlock\Controllers\AuthController;
use Nhivonfq\Unlock\Controllers\HomeController;
use Nhivonfq\Unlock\Controllers\SitesController;
use Nhivonfq\Unlock\boostrap\Application;
use Nhivonfq\Unlock\Database\Database;
use Nhivonfq\Unlock\Repository\UserRepository;
use Nhivonfq\Unlock\Services\UserServices;

error_reporting(E_ALL);
ini_set('display_errors', '1');

$config = [
    'userClass' => UserRepository::class,
    'db' => [
        'server' => $_ENV['DB_SERVER'],
        'port' => $_ENV['DB_PORT'],
        'name' => $_ENV['DB_NAME'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$connection = Database::getConnection($config['db']);

$userService = new UserServices($config);

$app = new Application(dirname(__DIR__));

$app->router->get('/', [HomeController::class, 'home']);

$app->router->get('/contact', [SitesController::class, 'contact']);

$app->router->post('/contact', [SitesController::class, 'handleRentCar']);
$app->router->post('/logout', [SitesController::class, 'logout']);

$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/login', [AuthController::class, 'login']);



$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/register', [AuthController::class, 'register']);


$app->run();

