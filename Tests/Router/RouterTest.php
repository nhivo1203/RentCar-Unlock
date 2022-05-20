<?php declare (strict_types=1);

namespace app\Tests\Router;

use Nhivonfq\Unlock\boostrap\Request;
use Nhivonfq\Unlock\boostrap\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{

    /**
     * @dataProvider sumDataProvider
     * @return void
     */
    public function testSum($params, $expected)
    {
        $request = $this->getMockBuilder(Request::class)->getMock();

        $router = new Router($request);

        $sum = $router->Sum($params['a'],$params['b']);

        $this->assertEquals($expected, $sum);

    }

    public function sumDataProvider():array {
        return [
            'case-with-a-1-b-2'=>[
                'params'=>[
                    'a'=>1,
                    'b'=>2
                ],
                'expected'=>3
            ],            'case-with-a-100-b-500'=>[
                'params'=>[
                    'a'=>100,
                    'b'=>500
                ],
                'expected'=>600
            ],            'case-with-a-1000-b-40000'=>[
                'params'=>[
                    'a'=>1000,
                    'b'=>40000
                ],
                'expected'=>41000
            ],
        ];
    }
}
