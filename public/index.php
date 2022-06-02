<?php
require_once __DIR__ . '/../vendor/autoload.php';
session_start();
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use Nhivonfq\Unlock\boostrap\Application;
use Nhivonfq\Unlock\Controllers\API\CreateBookingAPIController;
use Nhivonfq\Unlock\Controllers\API\CreateCarAPIController;
use Nhivonfq\Unlock\Controllers\API\GetCarController;
use Nhivonfq\Unlock\Controllers\API\LoginAPIController;
use Nhivonfq\Unlock\Controllers\API\RegisterAPIController;
use Nhivonfq\Unlock\Controllers\CreateBookingController;
use Nhivonfq\Unlock\Controllers\CreateCarController;
use Nhivonfq\Unlock\Controllers\HomeController;
use Nhivonfq\Unlock\Controllers\LoginController;
use Nhivonfq\Unlock\Controllers\RegisterController;
use Nhivonfq\Unlock\Controllers\SitesController;
use Nhivonfq\Unlock\Database\Database;
use Nhivonfq\Unlock\Models\UserModel;

error_reporting(E_ALL);
ini_set('display_errors', '1');

$config = [
    'db' => [
        'server' => $_ENV['DB_SERVER'],
        'port' => $_ENV['DB_PORT'],
        'name' => $_ENV['DB_NAME'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$connection = Database::getConnection($config['db']);

$app = new Application(dirname(__DIR__));

$app->router->get('/', [HomeController::class, 'home']);

$app->router->get('/contact', [SitesController::class, 'contact']);

$app->router->post('/logout', [LoginController::class, 'logout']);
$app->router->get('/logout', [LoginController::class, 'logout']);

$app->router->post('/login', [LoginController::class, 'login']);
$app->router->get('/login', [LoginController::class, 'login']);

$app->router->post('/api/login', [LoginAPIController::class, 'login']);
$app->router->get('/api/login', [LoginAPIController::class, 'login']);


$app->router->post('/register', [RegisterController::class, 'register']);
$app->router->get('/register', [RegisterController::class, 'register']);

$app->router->post('/api/register', [RegisterAPIController::class, 'register']);
$app->router->get('/api/register', [RegisterAPIController::class, 'register']);

$app->router->get('/api/cars', [GetCarController::class, 'getAllCar']);
$app->router->post('/api/cars', [GetCarController::class, 'getAllCar']);

$app->router->post('/api/createbooking', [CreateBookingAPIController::class, 'createBooking']);
$app->router->get('/api/createbooking', [CreateBookingAPIController::class, 'createBooking']);

$app->router->post('/createbooking', [CreateBookingController::class, 'createBooking']);
$app->router->get('/createbooking', [CreateBookingController::class, 'createBooking']);

$app->router->post('/createcar', [CreateCarController::class, 'createCar'], role: UserModel::ROLE_ADMIN);
$app->router->get('/createcar', [CreateCarController::class, 'createCar'], role: UserModel::ROLE_ADMIN);

$app->router->post('/api/createcar', [CreateCarAPIController::class, 'createCar'], role: UserModel::ROLE_ADMIN);
$app->router->get('/api/createcar', [CreateCarAPIController::class, 'createCar'], role: UserModel::ROLE_ADMIN);

$app->run();

