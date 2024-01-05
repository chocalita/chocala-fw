<?php

namespace Chocala\Web\Result;

use Chocala\Web\Result\Fakes\FakeActionData;
use PHPUnit\Framework\TestCase;

class PrintActionBodyTest extends TestCase
{

    public function test__construct()
    {
        $actionBody = new PrintActionBody();
        self::assertNotNull($actionBody);
        self::assertIsObject($actionBody);
        self::assertInstanceOf(ActionBodyInterface::class, $actionBody);
        self::assertInstanceOf(PrintActionBody::class, $actionBody);
    }

    public function testResult()
    {
        $fakeDataString = print_r(FakeActionData::DEFAULT_DATA, true);
        $emptyArrayString = print_r([], true);

        $actionBody = new PrintActionBody();
        self::assertIsObject($actionBody);
        $result = $actionBody->result(new FakeActionData());
        self::assertNotNull($result);
        self::assertNotEmpty($result);
        self::assertEquals($fakeDataString, $result);
        self::assertNotEquals($emptyArrayString, $result);

        $actionBody = new PrintActionBody();
        self::assertIsObject($actionBody);
        $result = $actionBody->result(new FakeActionData([]));
        self::assertNotNull($result);
        self::assertNotEmpty($result);
        self::assertNotEquals($fakeDataString, $result);
        self::assertEquals($emptyArrayString, $result);
    }

}