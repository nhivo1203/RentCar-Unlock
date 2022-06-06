<?php

namespace Nhivonfq\Unlock\Repository;

use Nhivonfq\Unlock\Models\CarModel;
use PDO;


class CarRepository extends BaseRepository
{
    private array $attributes = ['name', 'brand', 'type', 'image', 'price'];

    public function createCar(CarModel $car): ?CarModel
    {
        $statement = $this->getConnection()->prepare("INSERT INTO cars(" . implode(',', $this->getAttributes()) . ")
            VALUES(?, ?, ?, ?, ?)");
        $isCreated = $statement->execute([
            $car->getCarName(), $car->getCarBrand(), $car->getCarType(),
            $car->getImage(), $car->getPrice()
        ]);
        if ($isCreated) {
            return $car;
        }
        return null;
    }

    public function getAll(int $offset = 0, int $limit = 9): array
    {
        $sql = "SELECT * FROM cars LIMIT :off, :lim";
        $statement = $this->getConnection()->prepare($sql);
        $statement->bindValue(':off', $offset, PDO::PARAM_INT);
        $statement->bindValue(':lim', $limit, PDO::PARAM_INT);
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

    /**
     * @return array|string[]
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param array|string[] $attributes
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }
}
