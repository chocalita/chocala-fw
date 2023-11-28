<?php

namespace Chocala\Http;

require_once 'HttpMethodTest.php';

use \Exception;
class GetTest extends HttpMethodTest
{

    private function newObject(): Get
    {
        $_GET = $this->arrayQueryParams();
        return new Get();
    }

    public function testName()
    {
        $get = $this->newObject();
        self::assertIsObject($get);
        self::assertEquals(HttpMethod::GET, $get->name());
    }

    public function testId()
    {
        $get = $this->newObject();
        self::assertNotNull($get->id());
        self::assertGreaterThan(8, strlen($get->id()));
    }

    public function testQueryParams()
    {
        $get = $this->newObject();
        $size = sizeof($this->arrayQueryParams());
        self::assertNotNull($get->queryParams());
        self::assertIsObject($get->queryParams());
        self::assertCount($size, $get->queryParams()->data());
        unset($_GET['lastKey']);
        self::assertCount($size-1, $get->queryParams()->data());
    }

    public function testContent()
    {
        $get = $this->newObject();
        $this->expectException(Exception::class);
        $get->content();
    }

    public function testData()
    {
        $get = $this->newObject();
        $size = sizeof($this->arrayQueryParams());
        self::assertNotNull($get->data());
        self::assertIsArray($get->data());
        self::assertNotEmpty($get->data());
        self::assertCount($size, $get->data());
    }

}