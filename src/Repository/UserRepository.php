<?php

namespace Nhivonfq\Unlock\Repository;

use Nhivonfq\Unlock\Models\UserModel;

class UserRepository extends BaseRepository
{

    private array $attributes = ['firstname', 'lastname', 'email', 'password', 'role', 'username'];


    public function saveUser(UserModel $user): ?UserModel
    {
        $sql = "INSERT INTO users(" . implode(',', $this->getAttributes()) . ")
            VALUES(?, ?, ?, ?, ?, ?)";
        $statement = $this->getConnection()->prepare($sql);
        $isCreated = $statement->execute([
            $user->getFirstname(), $user->getLastname(), $user->getEmail(),
            $user->getPassword(), $user->getRole(), $user->getUsername()
        ]);
        if ($isCreated) {
            return $user;
        }
        return null;
    }

    public function findOne(array $where): ?UserModel
    {
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(static fn($attr) => "$attr = :$attr", $attributes));
        $statement = $this->getConnection()->prepare("SELECT * FROM users WHERE $sql");
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
                $user->setRole($row['role']);
                $user->setEmail($row['email']);
                $user->setCreateAt($row['createdAt']);
                return $user;
            }
            return null;
        } finally {
            $statement->closeCursor();
        }
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
