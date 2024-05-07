<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Http\Request\Parts\Fakes\FakeQueryParams;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use TypeError;

class QueryParamsTest extends TestCase
{
    private function newObject(): QueryParams
    {
        $_GET = FakeQueryParams::ARRAY_DATA;
        return new QueryParams();
    }

    public function test__construct()
    {
        $queryParams = new QueryParams();
        self::assertIsObject($queryParams);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/Too many arguments/');
        new QueryParams([100]);
    }

    public function testData()
    {
        $queryParams = $this->newObject();
        $size = sizeof(FakeQueryParams::ARRAY_DATA);
        self::assertNotNull($queryParams->data());
        self::assertNotEmpty($queryParams->data());
        self::assertIsArray($queryParams->data());
        self::assertCount($size, $queryParams->data());
        self::assertArrayHasKey('nullKey', $queryParams->data());
        $_GET['123'] = 123;
        self::assertCount($size + 1, $queryParams->data());
        self::assertEquals(123, $queryParams->get('123'));
        unset($_GET['lastKey']);
        self::assertCount($size, $queryParams->data());
    }

    public function testHas()
    {
        $queryParams = $this->newObject();
        self::assertIsBool($queryParams->has('var0'));
        self::assertIsBool($queryParams->has('INVALID_KEY'));
        self::assertTrue($queryParams->has('var0'));
        self::assertFalse($queryParams->has('INVALID_KEY'));
    }

    public function testGet()
    {
        $queryParams = $this->newObject();
        self::assertNull($queryParams->get('INVALID_KEY'));
        self::assertEquals('zero', $queryParams->get('var0'));
        self::assertIsNumeric($queryParams->get('numericKey'));
        self::assertIsArray($queryParams->get('arrayKey'));
        self::assertNull($queryParams->get('nullKey'));
        self::assertEquals('DEFAULT_VALUE', $queryParams->get('DEFAULT_01234XYZ', 'DEFAULT_VALUE'));
    }

    public function testDelete()
    {
        $queryParams = $this->newObject();
        $size = sizeof(FakeQueryParams::ARRAY_DATA);
        self::assertCount($size, $queryParams->data());
        $queryParams->delete('toRemoveKey');
        self::assertCount($size - 1, $queryParams->data());
        self::assertEquals($queryParams, $queryParams->delete('INVALID_KEY'));
        self::assertCount($size - 1, $queryParams->data());
    }

    public function testExtract()
    {
        $queryParams = $this->newObject();
        $size = sizeof(FakeQueryParams::ARRAY_DATA);
        self::assertCount($size, $queryParams->data());
        self::assertEquals('extractedValue', $queryParams->extract('extractedKey'));
        self::assertCount($size - 1, $queryParams->data());
        self::assertNull($queryParams->extract('INVALID_KEY'));
        self::assertCount($size - 1, $queryParams->data());
    }

    public function testGETNullValue()
    {
        // Setting $_GET value to null before object creation
        $_GET = null;
        $this->expectException(TypeError::class);
        $this->expectExceptionMessageRegExp('/must be array/');
        new QueryParams();
    }

    public function testGETSetToNullValue()
    {
        // Setting $_GET value to null after object creation
        $queryParams = $this->newObject();
        self::assertIsObject($queryParams);
        $this->expectException(TypeError::class);
        $this->expectExceptionMessageRegExp('/Cannot assign null to reference held by property/');
        $_GET = null;
    }
}
