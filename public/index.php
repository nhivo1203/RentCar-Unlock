<?php
require_once __DIR__ . '/../vendor/autoload.php';
session_start();

use Dotenv\Dotenv;
use Nhivonfq\Unlock\boostrap\Application;
use Nhivonfq\Unlock\boostrap\RoutesManage;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

RoutesManage::run();
$app = new Application(dirname(__DIR__));

$app->run();

