<?php

namespace Chocala\Http;

use Chocala\Http\Parts\Fakes\FakeMessageContent;
use Chocala\Http\Parts\FormUrlencodedData;
use InvalidArgumentException;

require_once 'HttpMethodTest.php';

class PutTest extends HttpMethodTest
{

    private function initParams()
    {
        $_GET = $this->arrayQueryParams();
        $_POST = $this->arrayFormData();
    }

    private function newObject(): Put
    {
        $this->initParams();
        return new Put(new FormUrlencodedData('key1=value1&key2=value2 & '));
    }

    public function testName()
    {
        $put = $this->newObject(new FakeMessageContent());
        self::assertIsObject($put);
        self::assertEquals(HttpMethod::PUT, $put->name());
    }

/*
    public function testBody()
    {
        $put = $this->newObject();
        //TODO: create tests
        self::assertEmpty($put->body());
    }
*/

    public function testConstructWithoutArgs()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/Invalid number of arguments/');
        new Put();
    }

}