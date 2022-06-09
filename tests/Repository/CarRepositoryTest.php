<?php

namespace Nhivonfq\Tests\Repository;

use Dotenv\Dotenv;
use Nhivonfq\Unlock\Database\Database;
use Nhivonfq\Unlock\Models\Car;
use Nhivonfq\Unlock\Repository\CarRepository;
use Nhivonfq\Unlock\Services\ConfigServices;
use PHPUnit\Framework\TestCase;

ConfigServices::run();

class CarRepositoryTest extends TestCase
{
    public function testSaveCarSuccess(): void
    {

        $carRepository = new CarRepository();
        $car = new Car();
        $car->setCarId(0);
        $car->setCarName('Car Test');
        $car->setCarType('Premium');
        $car->setCarBrand('Test');
        $car->setImage('testImage');
        $car->setPrice(1000);

        Database::getConnection();
        $saveCar = $carRepository->createCar($car);
        $this->assertEquals($saveCar, $car);
    }
//    public function testSaveCarFailed() {
//
//        $carRepository = new CarRepository();
//        $car = new CarModel();
//        $car->setCarId(0);
//        $car->setCarType('Premium');
//        $car->setImage('@#$%^&*$');
//
//        Database::getConnection();
//        $saveCar = $carRepository->createCar($car);
//        $this->assertNull($saveCar);
//    }

    public function testGetAllSuccess(): void
    {
        $carRepository = new CarRepository();
        $cars = $carRepository->getAll(0, 1);
        $carsExpected = $this->getCar(1, 'Mercedes G63', 'Premium', 'Mercedes',
            'https://i-vnexpress.vnecdn.net/2020/07/19/mercedes-g63-trail-package-vnexpress2-1595141855-1595144089_680x0.jpg',
            1000);
        $this->assertEquals($carsExpected, $cars);


    }


    private function getCar(int $id, string $name, string $type, string $brand, string $image, int $price,): array
    {
        $cars = [];
        $car = new Car();
        $car->setCarId($id);
        $car->setCarName($name);
        $car->setCarType($type);
        $car->setCarBrand($brand);
        $car->setImage($image);
        $car->setPrice($price);
        $cars[] = $car;

        return $cars;
    }
}
