<?php

namespace Nhivonfq\Unlock\Repository;

use Nhivonfq\Unlock\Database\Database;
use Nhivonfq\Unlock\Models\User;

class UserRepository
{


    public static array $attributes = ['firstname', 'lastname', 'email', 'password', 'status', 'username'];

    public static string $primaryKey = 'id';

    public function save(User $user): bool
    {
        $attributes = self::$attributes;

        $statement = $this->prepare("INSERT INTO users(" . implode(',', $attributes) . ")
            VALUES(
            '$user->firstname',
            '$user->lastname',
            '$user->email',
            '$user->password',
            '$user->status',
            '$user->username'
            )");
        $statement->execute();
        return true;
    }

    public function findOne($where)
    {
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(static fn($attr) => "$attr = :$attr", $attributes));
        $statement = $this->prepare("SELECT * FROM users WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public function prepare($sql)
    {
        return Database::prepare($sql);
    }
}
