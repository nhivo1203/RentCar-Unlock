<?php

namespace Nhivonfq\Tests\Services;

use Nhivonfq\Unlock\Services\SessionServices;
use PHPUnit\Framework\TestCase;

class SessionServicesTest extends TestCase
{
    /**
     * @return void
     */
    public function testSetSession():void
    {
        $session = new SessionServices();
        $session->set('user_id',7);
        $sessionExpected = isset($_SESSION['user_id']);
        $this->assertTrue($sessionExpected);
    }

    public function testHasSession():void {
        $session = new SessionServices();
        $session->set('user_id',7);
        $sessionExpected = $session->hasSession('user_id');
        $this->assertTrue($sessionExpected);
    }

    public function testRemoveSession():void {
        $session = new SessionServices();
        $session->set('user_id',7);
        $session->remove('user_id');
        $sessionExpected = $session->hasSession('user_id');
        $this->assertFalse($sessionExpected);
    }

}
