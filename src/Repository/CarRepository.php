<?php

namespace Nhivonfq\Unlock\Repository;

use Nhivonfq\Unlock\Database\Database;
use Nhivonfq\Unlock\Models\CarModel;



class CarRepository
{
    private array $attributes = ['name', 'brand', 'type', 'image', 'price'];

    public function createCar(CarModel $car): bool
    {
        $car_name = $car->getCarName();
        $car_brand = $car->getCarBrand();
        $car_type = $car->getCarType();
        $image = $car->getImage();
        $price = $car->getPrice();

        $statement = $this->prepare("INSERT INTO cars(" . implode(',', $this->attributes) . ")
            VALUES(
            '$car_name',
            '$car_brand',
            '$car_type',
            '$image',
            $price
            )");
        return $statement->execute();
    }

    public function getAll(): array
    {
        $statement = $this->prepare("SELECT * FROM cars");
        $statement->execute();
        $rows = $statement->fetchAll();
        $cars = [];
        foreach ($rows as $row) {
            $car = new CarModel();
            $car->setCarId($row['id']);
            $car->setCarName($row['name']);
            $car->setCarBrand($row['brand']);
            $car->setCarType($row['type']);
            $car->setImage($row['image']);
            $car->setPrice($row['price']);
            $cars[] = $car;
        }
        return $cars;
    }

    public function prepare($sql)
    {
        return Database::prepare($sql);
    }
}
