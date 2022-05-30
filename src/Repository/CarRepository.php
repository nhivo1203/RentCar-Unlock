<?php

namespace Nhivonfq\Unlock\Repository;

use Nhivonfq\Unlock\Database\Database;
use Nhivonfq\Unlock\Models\CarModel;
use PDO;
use RecursiveIteratorIterator;


class CarRepository
{
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
