<?php

namespace Chocala\Http\Parts;

use PHPUnit\Framework\TestCase;

class QueryParamsTest extends TestCase
{

    public const ARRAY_VALUES = [
            'var0' => 'zero',
            'numericKey' => 789,
            'arrayKey' => [],
            'nullKey' => null,
            'toRemoveKey' => 'toRemoveValue',
            'extractedKey' => 'extractedValue',
            'lastKey' => 'last'
        ];

    private function newObject(): QueryParams
    {
        $_GET = self::ARRAY_VALUES;
        return new QueryParams();
    }

    public function testData()
    {
        $queryParams = $this->newObject();
        $size = sizeof(self::ARRAY_VALUES);
        self::assertNotEmpty($queryParams->data());
        self::assertCount($size, $queryParams->data());
        $_GET['123'] = 123;
        self::assertCount($size + 1, $queryParams->data());
        self::assertEquals(123, $queryParams->get('123'));
        unset($_GET['lastKey']);
        self::assertCount($size, $queryParams->data());
    }

    public function testHas()
    {
        $get = $this->newObject();
        self::assertIsBool($get->has('var0'));
        self::assertIsBool($get->has('INVALID_KEY'));
        self::assertTrue($get->has('var0'));
        self::assertFalse($get->has('INVALID_KEY'));
    }

    public function testGet()
    {
        $get = $this->newObject();
        self::assertNull($get->get('INVALID_KEY'));
        self::assertEquals('zero', $get->get('var0'));
        self::assertIsNumeric($get->get('numericKey'));
        self::assertIsArray($get->get('arrayKey'));
        self::assertNull($get->get('nullKey'));
        self::assertEquals('DEFAULT_VALUE', $get->get('DEFAULT_01234XYZ', 'DEFAULT_VALUE'));
    }

    public function testDelete()
    {
        $get = $this->newObject();
        $size = sizeof(self::ARRAY_VALUES);
        self::assertCount($size, $get->data());
        $get->delete('toRemoveKey');
        self::assertCount($size - 1, $get->data());
        self::assertEquals($get, $get->delete('INVALID_KEY'));
        self::assertCount($size - 1, $get->data());
    }

    public function testExtract()
    {
        $get = $this->newObject();
        $size = sizeof(self::ARRAY_VALUES);
        self::assertCount($size, $get->data());
        self::assertEquals('extractedValue', $get->extract('extractedKey'));
        self::assertCount($size - 1, $get->data());
        self::assertNull($get->extract('INVALID_KEY'));
        self::assertCount($size - 1, $get->data());
    }

}
