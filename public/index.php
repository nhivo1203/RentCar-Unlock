<?php
require_once __DIR__ . '/../vendor/autoload.php';


use Nhivonfq\Unlock\Controllers\AuthController;
use Nhivonfq\Unlock\Controllers\SitesController;
use Nhivonfq\Unlock\Core\Application;

error_reporting(E_ALL);
ini_set('display_errors', '1');

$app = new Application(dirname(__DIR__));

$app->router->get('/', [new SitesController(), 'home']);

$app->router->get('/contact', [new SitesController(), 'contact']);

$app->router->post('/contact', [new SitesController(), 'handleRentCar']);

$app->router->post('/login', [new AuthController(), 'login']);
$app->router->get('/login', [new AuthController(), 'login']);

$app->router->post('/register', [new AuthController(), 'register']);
$app->router->get('/register', [new AuthController(), 'register']);


$app->run();

