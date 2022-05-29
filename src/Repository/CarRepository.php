<?php

namespace Nhivonfq\Unlock\Repository;

use Nhivonfq\Unlock\Database\Database;
use PDO;
use RecursiveIteratorIterator;


class CarRepository
{
    public function getAll(): array
    {
        $statement = $this->prepare("SELECT * FROM cars");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function prepare($sql)
    {
        return Database::prepare($sql);
    }
}
