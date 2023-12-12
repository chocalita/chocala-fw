<?php

namespace Http;

use Chocala\Http\Requests;
use PHPUnit\Framework\TestCase;

class RequestsTest extends TestCase
{

    public function test__construct()
    {
        $object = new Requests();
        self::assertNotNull($object);
        self::assertIsObject($object);
        self::assertInstanceOf(Requests::class, $object);
        self::assertObjectHasAttribute('serverVars', $object);
        self::assertObjectHasAttribute('requestVars', $object);
    }

    public function testMake()
    {
        // TODO: implement tests
        self::assertEquals(1, '1');
    }
}
