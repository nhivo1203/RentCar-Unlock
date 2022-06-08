<?php

namespace Nhivonfq\Tests\Repository;

use Dotenv\Dotenv;
use Nhivonfq\Unlock\Database\Database;
use Nhivonfq\Unlock\Models\UserModel;
use Nhivonfq\Unlock\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

class UserRepositoryTest extends TestCase
{
    public function testSaveUserSuccess(): void
    {
        $userRepository = new UserRepository();
        $user = new UserModel();
        $user->setFirstname('Vo Nguyen');
        $user->setLastname('Thien Long');
        $user->setEmail('thienlong@gmail.com');
        $user->setPassword('123456789');
        $user->setRole(0);
        $user->setUsername('thienlong');

        Database::getConnection();
        $userSaved = $userRepository->saveUser($user);
        $this->assertEquals($user, $userSaved);
    }

    public function testFindOneUser(): void
    {
        $userRepository = new UserRepository();
        Database::getConnection();
        $userResult = $userRepository->findOne(['email' => 'vonhi1604@gmail.com']);
        $this->assertEquals('vonhi1604@gmail.com', $userResult->getEmail());
    }
}
