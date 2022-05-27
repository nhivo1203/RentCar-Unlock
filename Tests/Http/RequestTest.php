<?php

namespace Nhivonfq\Tests\Http;

use Nhivonfq\Unlock\Http\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    /**
     * @dataProvider getPathProvider
     * @return void
     */
    public function testGetPath($param, $expected)
    {
        $request = new Request();
        $_SERVER['REQUEST_URI'] = $param;
        $this->assertEquals($expected, $request->getPath());
    }

    /**
     * @dataProvider getMethodProvider
     * @return void
     */
    public function testGetMethod($param)
    {
        $request = new Request();
        $_SERVER['REQUEST_METHOD'] = $param;
        $this->assertEquals($param, $request->getMethod());
    }

    public function testIsPost() {
        $request = new Request();
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $isPost = $request->isPost();
        $this->assertTrue($isPost);

    }


    public function getMethodProvider()
    {
        return [
            ['get'],
            ['post'],
            ['put'],
            ['delete'],
            ['patch'],
            ['head'],
            ['options'],
        ];
    }

    public function getPathProvider()
    {
        return [
            'get-path-case-1' => [
                'param' => '/login?redirect=true',
                'expected' => '/login',
            ],
            'get-path-case-2' => [
                'param' => '/login',
                'expected' => '/login',
            ],
            'get-path-case-3' => [
                'param' => '/home?redirect=true',
                'expected' => '/home',
            ],
        ];
    }
}
