<?php

namespace Chocala\Http;

require_once 'HttpMethodTest.php';

use Chocala\Http\Parts\QueryParamsInterface;
use \Exception;
class DeleteTest extends HttpMethodTest
{

    private function newObject(): Delete
    {
        $this->initQueryParams();
        return new Delete();
    }

    public function testName()
    {
        $delete = $this->newObject();
        self::assertIsObject($delete);
        self::assertEquals(HttpMethod::DELETE, $delete->name());
    }

    public function testId()
    {
        $delete = $this->newObject();
        self::assertNotNull($delete->id());
        self::assertGreaterThan(8, strlen($delete->id()));
    }

    public function testQueryParams()
    {
        $delete = $this->newObject();
        $size = sizeof($this->arrayQueryParams());
        self::assertNotNull($delete->queryParams());
        self::assertIsObject($delete->queryParams());
        self::assertInstanceOf(QueryParamsInterface::class, $delete->queryParams());
        self::assertCount($size, $delete->queryParams()->data());
        unset($_GET['lastKey']);
        self::assertCount($size-1, $delete->queryParams()->data());
    }

    public function testContent()
    {
        $delete = $this->newObject();
        $this->expectException(Exception::class);
        $this->expectExceptionCode(0);
        $this->expectExceptionMessageRegExp('/does not have body content/');
        $delete->content();
    }

    public function testData()
    {
        $delete = $this->newObject();
        $size = sizeof($this->arrayQueryParams());
        self::assertNotNull($delete->data());
        self::assertIsArray($delete->data());
        self::assertNotEmpty($delete->data());
        self::assertCount($size, $delete->data());
    }

}