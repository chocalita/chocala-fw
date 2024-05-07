<?php

namespace Chocala\Http\Request\Parts;

require_once 'CustomRequestDataTest.php';

use Chocala\Base\UnsupportedOperationException;

class RequestDataNoBodyTest extends CustomRequestDataTest
{
    private function newObject(): RequestDataNoBody
    {
        $this->initQueryParams();
        return new RequestDataNoBody();
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
        $requestDataNoBody = $this->newObject();
        $size = sizeof($this->arrayQueryParams());
        self::assertNotNull($requestDataNoBody->queryParams());
        self::assertIsObject($requestDataNoBody->queryParams());
        self::assertInstanceOf(QueryParamsInterface::class, $requestDataNoBody->queryParams());
        self::assertCount($size, $requestDataNoBody->queryParams()->data());
        unset($_GET['lastKey']);
        self::assertCount($size - 1, $requestDataNoBody->queryParams()->data());
    }

    public function testBody()
    {
        $requestDataNoBody = $this->newObject();
        $this->expectException(UnsupportedOperationException::class);
        $this->expectExceptionCode(41);
        $this->expectExceptionMessageRegExp('/does not support body content/');
        $requestDataNoBody->body();
    }

    public function testData()
    {
        $requestDataNoBody = $this->newObject();
        $size = sizeof($this->arrayQueryParams());
        self::assertNotNull($requestDataNoBody->data());
        self::assertIsArray($requestDataNoBody->data());
        self::assertNotEmpty($requestDataNoBody->data());
        self::assertCount($size, $requestDataNoBody->data());
    }
}
