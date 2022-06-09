<?php

namespace Nhivonfq\Tests\Services;

use Nhivonfq\Unlock\Models\User;
use Nhivonfq\Unlock\Repository\UserRepository;
use Nhivonfq\Unlock\Request\RegisterRequest;
use Nhivonfq\Unlock\Services\RegisterServices;
use PHPUnit\Framework\TestCase;

class RegisterServicesTest extends TestCase
{
    /**
     * @dataProvider registerSuccessProvider
     * @param array $params
     * @return void
     */
    public function testRegisterSuccess(array $params, $expected) {
        $registerRequest = new RegisterRequest();
        $user = new User();
        $registerRequest->fromArray($params);
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('saveUser')->willReturn($params['isSave']);
        $registerServices = new RegisterServices($userRepositoryMock);
        $isRegisterResult = $registerServices->register($registerRequest);
        $this->assertEquals($expected, $isRegisterResult);
    }



    private function getUser(int $id,string $firstname, string $lastname,string $email,int $role, string $username, string $password, string $createAt): User
    {
        $user = new User();
        $user->setId($id);
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setEmail($email);
        $user->setRole($role);
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setCreateAt($createAt);

        return $user;
    }

    private function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @return array[]
     */
    public function registerSuccessProvider()
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'firstname' => 'Vo',
                    'lastname' => 'Thien',
                    'email' => 'vothien1203@gmail.com',
                    'role' => 0,
                    'username' => 'vothien1203',
                    'password' => '123456789',
                    'isSave' => true,
                ],
                'expected' => (
                    $this->getUser(2, 'Vo','Thien','vothien1203@gmail.com',0,'vothien1203' ,$this->hashPassword('123456789'), '06-03-2022')
                )

            ],
            'happy-case-2' => [
                'params' => [
                    'firstname' => 'Vo',
                    'lastname' => 'Long',
                    'email' => 'volong1604@gmail.com',
                    'role' => 0,
                    'username' => 'volong1604',
                    'password' => '123456789',
                    'isSave' => true,
                ],
                'expected' => (
                    $this->getUser(3, 'Vo','Long','volong1604@gmail.com',0,'volong1604' ,$this->hashPassword('123456789'), '06-03-2022')
                )
            ],
        ];
    }
}
