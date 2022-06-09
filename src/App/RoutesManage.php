<?php

namespace Nhivonfq\Unlock\App;

use Nhivonfq\Unlock\Controllers\API\CarAPIController;
use Nhivonfq\Unlock\Controllers\API\CreateBookingAPIController;
use Nhivonfq\Unlock\Controllers\API\LoginAPIController;
use Nhivonfq\Unlock\Controllers\API\RegisterAPIController;
use Nhivonfq\Unlock\Controllers\CarController;
use Nhivonfq\Unlock\Controllers\CreateBookingController;
use Nhivonfq\Unlock\Controllers\HomeController;
use Nhivonfq\Unlock\Controllers\LoginController;
use Nhivonfq\Unlock\Controllers\RegisterController;
use Nhivonfq\Unlock\Controllers\SitesController;
use Nhivonfq\Unlock\Models\User;

class RoutesManage
{


    public static function run(): void
    {
        self::appRoutes();
        self::apiRoutes();
    }

    public static function appRoutes(): void
    {

        Router::get('/', [CarController::class, 'home']);
        Router::post('/logout', [LoginController::class, 'logout']);
        Router::get('/logout', [LoginController::class, 'logout']);
        Router::post('/login', [LoginController::class, 'login']);
        Router::get('/login', [LoginController::class, 'login']);
        Router::post('/register', [RegisterController::class, 'register']);
        Router::get('/register', [RegisterController::class, 'register']);
        Router::post('/createbooking', [CreateBookingController::class, 'createBooking'], role: User::ROLE_MEMBER);
        Router::get('/createbooking', [CreateBookingController::class, 'createBooking'], role: User::ROLE_MEMBER);
        Router::post('/createcar', [CarController::class, 'createCar'], role: User::ROLE_ADMIN);
        Router::get('/createcar', [CarController::class, 'createCar'], role: User::ROLE_ADMIN);

    }

    public static function apiRoutes(): void
    {
        Router::post('/api/login', [LoginAPIController::class, 'login']);
        Router::get('/api/login', [LoginAPIController::class, 'login']);
        Router::post('/api/register', [RegisterAPIController::class, 'register']);
        Router::get('/api/register', [RegisterAPIController::class, 'register']);
        Router::get('/api/cars', [CarAPIController::class, 'getAllCar']);
        Router::post('/api/cars', [CarAPIController::class, 'getAllCar']);
        Router::post('/api/createbooking', [CreateBookingAPIController::class, 'createBooking'], role: User::ROLE_MEMBER);
        Router::get('/api/createbooking', [CreateBookingAPIController::class, 'createBooking'], role: User::ROLE_MEMBER);
        Router::post('/api/createcar', [CarAPIController::class, 'createCar'], role: User::ROLE_ADMIN);
        Router::get('/api/createcar', [CarAPIController::class, 'createCar'], role: User::ROLE_ADMIN);
    }
}
