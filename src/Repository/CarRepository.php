<?php

namespace Nhivonfq\Unlock\Repository;

use Nhivonfq\Unlock\Models\CarModel;
use PDO;


class CarRepository extends BaseRepository
{
    private array $attributes = ['name', 'brand', 'type', 'image', 'price'];

    public function createCar(CarModel $car): ?CarModel
    {
        $statement = $this->getConnection()->prepare(
            "INSERT INTO cars(" . implode(',', $this->getAttributes()) . ")
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

    public function toArray($data): array {
        $cars = [];
        foreach ($data as $row) {
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

    public function getAll(int $offset = 0, int $limit = 9): array
    {
        $sql = "SELECT * FROM cars LIMIT :offset, :limit";
        $statement = $this->getConnection()->prepare($sql);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->execute();
        $rows = $statement->fetchAll();
        return $this->toArray($rows);
    }

    /**
     * @return array|string[]
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
