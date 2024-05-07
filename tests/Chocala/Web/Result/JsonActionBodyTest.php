<?php

namespace Chocala\Web\Result;

use Chocala\Web\Result\Fakes\FakeActionData;
use PHPUnit\Framework\TestCase;

class JsonActionBodyTest extends TestCase
{
    public function test__construct()
    {
        $actionBody = new JsonActionBody();
        self::assertNotNull($actionBody);
        self::assertIsObject($actionBody);
        self::assertInstanceOf(ActionBodyInterface::class, $actionBody);
        self::assertInstanceOf(JsonActionBody::class, $actionBody);
    }

    public function testResult()
    {
        $fakeDataJson = json_encode(FakeActionData::DEFAULT_DATA);
        $emptyArrayJson = '[]';

        $actionBody = new JsonActionBody();
        self::assertIsObject($actionBody);
        $result = $actionBody->result(new FakeActionData());
        self::assertNotNull($result);
        self::assertNotEmpty($result);
        self::assertJson($result);
        self::assertEquals($fakeDataJson, $result);
        self::assertNotEquals($emptyArrayJson, $result);
        //echo $result;

        $actionBody = new JsonActionBody();
        self::assertIsObject($actionBody);
        $result = $actionBody->result(new FakeActionData([]));
        self::assertNotNull($result);
        self::assertNotEmpty($result);
        self::assertNotEquals($fakeDataJson, $result);
        self::assertEquals($emptyArrayJson, $result);
        //echo $result;

        // TODO return empty string and empty object (this method always returns empty array)
        $actionBody = new JsonActionBody();
        self::assertIsObject($actionBody);
        $result = $actionBody->result(new ActionData());
        self::assertNotNull($result);
        self::assertNotEmpty($result);
        self::assertNotEquals($fakeDataJson, $result);
        self::assertEquals($emptyArrayJson, $result);
        //echo $result;
    }
}
