<?php

namespace Http\Request\Parts;

use Chocala\Http\Headers;
use Chocala\Http\HttpMethod;
use Chocala\Http\Request\Parts\Fakes\FakeQueryParams;
use Chocala\Http\Request\Parts\Fakes\FakeRequestHeaders;
use Chocala\Http\Request\Parts\RequestData;
use Chocala\Http\Request\Parts\RequestDataInterface;
use Chocala\Http\Request\Parts\RequestDataNoBody;
use Chocala\Http\Request\Parts\RequestDatas;
use Chocala\Http\Request\Parts\RequestHeaders;
use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class RequestDatasTest extends TestCase
{
    private RequestDatas $requestDatas;
    private array $noBodyMethods;
    private array $withBodyMethods;

    private function createHeaders(string $contentType): RequestHeaders
    {
        return new RequestHeaders(
            [
            Headers::CONTENT_TYPE_KEY => $contentType
            ]
        );
    }

    public function setUp()
    {
        $this->requestDatas = new RequestDatas();
        $allMethods = HttpMethod::all();
        $this->noBodyMethods = array_filter(
            $allMethods,
            function ($xMethod) {
                return $xMethod->isSafe();
            }
        );
        $this->withBodyMethods = array_filter(
            $allMethods,
            function ($xMethod) {
                return !$xMethod->isSafe();
            }
        );
    }

    public function test__construct()
    {
        $object = new RequestDatas();
        self::assertNotNull($object);
        self::assertIsObject($object);
        self::assertInstanceOf(RequestDatas::class, $object);

        self::assertNotNull($this->requestDatas);
        self::assertIsObject($this->requestDatas);
        self::assertInstanceOf(RequestDatas::class, $this->requestDatas);
    }

    public function testMake()
    {
        $requestData = $this->requestDatas->make(
            HttpMethod::GET(),
            new FakeRequestHeaders(),
            new FakeQueryParams()
        );
        self::assertNotNull($requestData);
        self::assertIsObject($requestData);
        self::assertInstanceOf(RequestDataInterface::class, $requestData);
        self::assertInstanceOf(RequestDataNoBody::class, $requestData);
        self::assertNotInstanceOf(RequestData::class, $requestData);

        $requestData = $this->requestDatas->make(
            HttpMethod::POST(),
            new FakeRequestHeaders(),
            new FakeQueryParams()
        );
        self::assertNotNull($requestData);
        self::assertIsObject($requestData);
        self::assertInstanceOf(RequestDataInterface::class, $requestData);
        self::assertInstanceOf(RequestData::class, $requestData);
        self::assertNotInstanceOf(RequestDataNoBody::class, $requestData);
    }

    public function testRequestDataNoBody()
    {
        $headers = $this->createHeaders(ContentType::TEXT_HTML);
        $queryParams = new FakeQueryParams();
        foreach ($this->noBodyMethods as $method) {
            $requestData = $this->requestDatas->make(
                $method,
                $headers,
                $queryParams
            );
            self::assertNotNull($requestData);
            self::assertIsObject($requestData);
            self::assertInstanceOf(RequestDataInterface::class, $requestData);
            self::assertInstanceOf(RequestDataNoBody::class, $requestData);
        }

        $this->requestDatas->make(reset($this->withBodyMethods), $headers, $queryParams);
    }

    public function testRequestData()
    {
        $headers = $this->createHeaders(ContentType::APPLICATION_JSON);
        $queryParams = new FakeQueryParams();
        foreach ($this->withBodyMethods as $method) {
            $requestData = $this->requestDatas->make(
                $method,
                $headers,
                $queryParams
            );
            self::assertNotNull($requestData);
            self::assertIsObject($requestData);
            self::assertInstanceOf(RequestDataInterface::class, $requestData);
            self::assertInstanceOf(RequestData::class, $requestData);
        }
    }
}
