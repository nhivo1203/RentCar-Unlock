<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use Nhivonfq\Unlock\Controllers\AuthController;
use Nhivonfq\Unlock\Controllers\SitesController;
use Nhivonfq\Unlock\boostrap\Application;

error_reporting(E_ALL);
ini_set('display_errors', '1');

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [new SitesController(), 'home']);

$app->router->get('/contact', [new SitesController(), 'contact']);

$app->router->post('/contact', [new SitesController(), 'handleRentCar']);

$app->router->post('/login', [new AuthController(), 'login']);
$app->router->get('/login', [new AuthController(), 'login']);

$app->router->post('/register', [new AuthController(), 'register']);
$app->router->get('/register', [new AuthController(), 'register']);


$app->run();

