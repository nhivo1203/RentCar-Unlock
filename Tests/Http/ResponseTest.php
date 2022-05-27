<?php

namespace Nhivonfq\Tests\Http;


use Nhivonfq\Unlock\Http\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testGetTemplate()
    {
        $response = new Response();
        $response->setTemplate('index.php');
        $this->assertEquals('index.php', $response->getTemplate());
    }

    /**
     * @dataProvider getStatusCodeProvider
     * @return void
     */
    public function testGetStatusCode($param)
    {
        $response = new Response();
        $response->setStatusCode($param);
        $this->assertEquals($param, $response->getStatusCode());
    }

    public function getStatusCodeProvider()
    {
        return [
            [Response::HTTP_OK],
            [Response::HTTP_NOT_FOUND],
            [Response::HTTP_INTERNAL_SERVER_ERROR],
            [Response::HTTP_UNAUTHORIZED],
        ];
    }

    /**
     * @dataProvider getRedirectUrlProvider
     * @return void
     */
    public function testGetRedirectUrl($param)
    {
        $response = new Response();
        $response->setRedirectUrl($param);
        $this->assertEquals($param, $response->getRedirectUrl());
    }

    public function getRedirectUrlProvider()
    {
        return [
            ['/login'],
            ['/home'],
            ['/car'],
        ];
    }

    /**
     * @dataProvider getDataProvider
     * @return void
     */
    public function testGetData()
    {
        $response = new Response();
        $response->setData(['name' => 'Nhi Vo']);
        $this->assertEquals(['name' => 'Nhi Vo'], $response->getData());
    }

    public function getDataProvider()
    {
        return [
            [['name' => 'Nhi Vo']],
            [['name' => 'Nhi Vo', 'age' => 22]],
        ];
    }
}
