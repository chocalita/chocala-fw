<?php

namespace Http\Request\Parts;

use Chocala\Http\HttpMethod;
use Chocala\Http\HttpMethodEnum;
use Chocala\Http\Request\Parts\Fakes\FakeMessageBody;
use Chocala\Http\Request\Parts\Fakes\FakeQueryParams;
use Chocala\Http\Request\Parts\RequestData;
use Chocala\Http\Request\Parts\RequestDatas;
use PHPUnit\Framework\TestCase;

class RequestDatasTest extends TestCase
{

    public function test__construct()
    {
        $object = new RequestDatas();
        self::assertNotNull($object);
        self::assertIsObject($object);
        self::assertInstanceOf(RequestDatas::class, $object);
    }

//    public function testMake()
//    {
//        $object = new RequestDatas();
//        $requestData = $object->make(
//            HttpMethod::OPTIONS(),
//            new FakeQueryParams(),
//            new FakeMessageBody()
//        );
//        self::assertInstanceOf(RequestData::class, $requestData);
//    }

}
