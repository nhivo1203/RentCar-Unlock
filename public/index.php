<?php
require_once __DIR__ . '/../vendor/autoload.php';
session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');

use Dotenv\Dotenv;
use Nhivonfq\Unlock\boostrap\Application;
use Nhivonfq\Unlock\boostrap\RoutesManage;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

RoutesManage::run();
$app = new Application(dirname(__DIR__));

$app->run();

