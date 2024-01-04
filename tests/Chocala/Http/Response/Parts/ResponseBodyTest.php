<?php

namespace Chocala\Http\Response\Parts;

use ArgumentCountError;
use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class ResponseBodyTest extends TestCase
{

    private const DEFAULT_DATA = [
        'name' => 'John',
        'lastname' => 'Doe'
    ];

    private ResponseBody $responseBody;
    public function setUp()
    {
        $jsonContent = json_encode(self::DEFAULT_DATA);
        $this->responseBody = new ResponseBody(ContentType::APPLICATION_JSON, $jsonContent);
    }

    public function test__construct()
    {
        self::assertNotNull($this->responseBody);
        self::assertIsObject($this->responseBody);
        self::assertInstanceOf(ResponseBodyInterface::class, $this->responseBody);
        self::assertInstanceOf(ResponseBody::class, $this->responseBody);

        $bodyContent = '';
        $responseBody = new ResponseBody(ContentType::TEXT_PLAIN, $bodyContent);
        self::assertNotNull($responseBody);
        self::assertIsObject($responseBody);
        self::assertInstanceOf(ResponseBodyInterface::class, $responseBody);
        self::assertInstanceOf(ResponseBody::class, $responseBody);

        $this->expectException(ArgumentCountError::class);
        $this->expectExceptionMessageRegExp('/Too few arguments to function/');
        new ResponseBody(ContentType::TEXT_PLAIN);
    }

    public function testType()
    {
        $type = $this->responseBody->type();
        self::assertNotNull($type);
        self::assertNotEmpty($type);
        self::assertEquals(ContentType::APPLICATION_JSON, $type);

        $bodyContent = '<html><head></head><body><h1>some tittle</h1></body></html>';
        $responseBody = new ResponseBody(ContentType::TEXT_HTML, $bodyContent);
        self::assertIsObject($responseBody);
        $type = $responseBody->type();
        self::assertNotNull($type);
        self::assertNotEmpty($type);
        self::assertEquals(ContentType::TEXT_HTML, $type);
    }

    public function testData()
    {
        $data = $this->responseBody->data();
        $expected = json_encode(self::DEFAULT_DATA);
        self::assertNotNull($data);
        self::assertNotEmpty($data);
        self::assertEquals($expected, $data);

        $bodyContent = '<html><head></head><body><h1>some tittle</h1></body></html>';
        $responseBody = new ResponseBody(ContentType::TEXT_HTML, $bodyContent);
        $data = $responseBody->data();
        self::assertNotNull($data);
        self::assertNotEmpty($data);
        self::assertEquals($bodyContent, $data);
    }

}