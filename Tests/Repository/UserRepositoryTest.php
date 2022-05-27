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
    public function testSaveUser() {
        $config = [
            'db' => [
                'server' => $_ENV['DB_SERVER'],
                'port' => $_ENV['DB_PORT'],
                'name' => $_ENV['DB_NAME'],
                'user' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASSWORD'],
            ]
        ];

        $userRepository = new UserRepository();
        $user = new UserModel();
        $user->setFirstname('Vo Nguyen');
        $user->setLastname('Thien Long');
        $user->setEmail('thienlong@gmail.com');
        $user->setPassword('123456789');
        $user->setStatus(0);
        $user->setUsername('thienlong');

        Database::getConnection($config['db']);
        $isSaveUser = $userRepository->save($user);
        $this->assertTrue($isSaveUser);
    }

    public function testFindOneUser() {

        $config = [
            'db' => [
                'server' => $_ENV['DB_SERVER'],
                'port' => $_ENV['DB_PORT'],
                'name' => $_ENV['DB_NAME'],
                'user' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASSWORD'],
            ]
        ];

        $userModel = new UserModel();
        $userRepository = new UserRepository($userModel);
        Database::getConnection($config['db']);
        $userResult = $userRepository->findOne(['email' => 'vonhi1604@gmail.com']);
        $this->assertEquals('vonhi1604@gmail.com', $userResult->getEmail());
    }
}
