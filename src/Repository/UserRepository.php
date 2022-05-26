<?php

namespace Nhivonfq\Unlock\Repository;

use Nhivonfq\Unlock\Database\Database;
use Nhivonfq\Unlock\Models\UserModel;

class UserRepository
{

    private array $attributes = ['firstname', 'lastname', 'email', 'password', 'status', 'username'];
    private UserModel $user;

    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    public function save(): bool
    {

        $statement = $this->prepare("INSERT INTO users(" . implode(',', $this->attributes) . ")
            VALUES(
            '$this->user->getFirstname()',
            '$this->user->getLastname()',
            '$this->user->getEmail()',
            '$this->user->getPassword()',
            '$this->user->getStatus()',
            '$this->user->getUsername()'
            )");
        $statement->execute();
        return true;
    }

    public function findOne($where): ?UserModel
    {
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(static fn($attr) => "$attr = :$attr", $attributes));
        $statement = $this->prepare("SELECT * FROM users WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        try {
            $user = new UserModel();
            if ($row = $statement->fetch()) {
                $user->setId($row['id']);
                $user->setUsername($row['username']);
                $user->setPassword($row['password']);
                $user->setFirstName($row['firstname']);
                $user->setLastname($row['lastname']);
                $user->setStatus($row['status']);
                $user->setEmail($row['email']);
                $user->setCreateAt($row['createdAt']);
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function prepare($sql)
    {
        return Database::prepare($sql);
    }
}
