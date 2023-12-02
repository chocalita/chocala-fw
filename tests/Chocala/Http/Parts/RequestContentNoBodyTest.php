<?php

namespace Chocala\Http\Parts;

require_once 'CustomRequestContentTest.php';

use Exception;

class RequestContentNoBodyTest extends CustomRequestContentTest
{

    private function newObject(): RequestContentNoBody
    {
        $this->initQueryParams();
        return new RequestContentNoBody();
    }

    // Move this test to Request class
//    public function testId()
//    {
//        $get = $this->newObject();
//        self::assertNotNull($get->id());
//        self::assertGreaterThan(8, strlen($get->id()));
//    }

    public function testQueryParams()
    {
        $requestContentNoBody = $this->newObject();
        $size = sizeof($this->arrayQueryParams());
        self::assertNotNull($requestContentNoBody->queryParams());
        self::assertIsObject($requestContentNoBody->queryParams());
        self::assertInstanceOf(QueryParamsInterface::class, $requestContentNoBody->queryParams());
        self::assertCount($size, $requestContentNoBody->queryParams()->data());
        unset($_GET['lastKey']);
        self::assertCount($size-1, $requestContentNoBody->queryParams()->data());
    }

    public function testBody()
    {
        $requestContentNoBody = $this->newObject();
        $this->expectException(Exception::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessageRegExp('/does not have body content/');
        $requestContentNoBody->body();
    }

    public function testData()
    {
        $requestContentNoBody = $this->newObject();
        $size = sizeof($this->arrayQueryParams());
        self::assertNotNull($requestContentNoBody->data());
        self::assertIsArray($requestContentNoBody->data());
        self::assertNotEmpty($requestContentNoBody->data());
        self::assertCount($size, $requestContentNoBody->data());
    }

}