<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Nhivonfq\Unlock\Controllers\SitesController;
use Nhivonfq\Unlock\Core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', 'home');

$app->router->get('/contact', 'contact');

$app->router->post('/contact', [new SitesController(), 'handleRentCar']);

$app->run();

