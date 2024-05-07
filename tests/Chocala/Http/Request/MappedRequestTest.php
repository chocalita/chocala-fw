<?php

namespace Chocala\Http\Request;

use ArgumentCountError;
use Chocala\Http\Fakes\FakeRequest;
use Chocala\Http\HttpMethod;
use Chocala\Http\HttpMethodEnum;
use Chocala\Http\Request\Parts\Fakes\FakeRequestData;
use Chocala\Http\Request\Parts\Fakes\FakeRequestHeaders;
use Chocala\Http\Request\Parts\RequestLine;
use Chocala\Http\RequestInterface;
use Chocala\Http\Route\DefaultRoutes;
use Chocala\Http\Route\Fakes\FakeRoutes;
use Chocala\Http\Route\Fakes\FakeRoutesMapping;
use Chocala\Http\Route\RoutesMapping;
use PHPUnit\Framework\TestCase;

class MappedRequestTest extends TestCase
{
    /**
     * @var FakeRequest
     */
    private FakeRequest $fakeRequest;

    /**
     * @var FakeRoutesMapping
     */
    private FakeRoutesMapping $fakeRoutesMapping;

    public function setUp()
    {
        $this->fakeRequest = new FakeRequest();
        $this->fakeRoutesMapping = new FakeRoutesMapping();
    }

    public function test__construct()
    {
        $mappedRequest = new MappedRequest($this->fakeRequest, $this->fakeRoutesMapping);
        self::assertNotEmpty($mappedRequest);
        self::assertIsObject($mappedRequest);
        self::assertInstanceOf(RequestInterface::class, $mappedRequest);
        self::assertInstanceOf(MappedRequest::class, $mappedRequest);

        $this->expectException(ArgumentCountError::class);
        new MappedRequest();
    }

    public function testRequestLine()
    {
        $request = $this->fakeRequest;
        // FakeRoutesMapping always this returns the same 'requestUri' as the original request
        $mappedRequest = new MappedRequest($request, $this->fakeRoutesMapping);
        $this->assertsRequestLine($mappedRequest);
        self::assertNotEquals($request->requestLine(), $mappedRequest->requestLine());
        self::assertEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());

        // Request object returns the same 'requestUri' as the original request
        $request = $this->createRequest('/', HttpMethod::GET());
        $mappedRequest = new MappedRequest($request, $this->fakeRoutesMapping);
        $this->assertsRequestLine($mappedRequest);
        self::assertEquals($request->requestLine(), $mappedRequest->requestLine());
        self::assertEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());

        // RoutesMapping applying DefaultRoutes routing
        $routesMapping = new RoutesMapping(new DefaultRoutes());

        $request = $this->createRequest('', HttpMethod::GET());
        $mappedRequest = new MappedRequest($request, $routesMapping);
        self::assertNotNull($mappedRequest->requestLine());
        self::assertIsObject($mappedRequest->requestLine());
        self::assertEmpty($mappedRequest->requestLine()->requestUri());
        self::assertIsString($mappedRequest->requestLine()->requestUri());
        self::assertEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('', $mappedRequest->requestLine()->requestUri());

        $request = $this->createRequest('/', HttpMethod::GET());
        $mappedRequest = new MappedRequest($request, $routesMapping);
        $this->assertsRequestLine($mappedRequest);
        self::assertNotEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('/main/system/index', $mappedRequest->requestLine()->requestUri());

        $request = $this->createRequest('/contact', HttpMethod::GET());
        $mappedRequest = new MappedRequest($request, $routesMapping);
        $this->assertsRequestLine($mappedRequest);
        self::assertNotEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('/main/system/contact', $mappedRequest->requestLine()->requestUri());
    }

    public function testRequestLineMapped()
    {
        $routesMapping = new RoutesMapping(new FakeRoutes());

        $key = '/context-module/page/action/ID';
        $request = $this->createRequest($key, HttpMethod::GET());
        $mappedRequest = new MappedRequest($request, $routesMapping);
        $this->assertsRequestLine($mappedRequest);
        self::assertEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals($key, $mappedRequest->requestLine()->requestUri());

        $key = '/moduleX/pageX/actionX/99';
        $request = $this->createRequest($key, HttpMethod::POST());
        $mappedRequest = new MappedRequest($request, $routesMapping);
        $this->assertsRequestLine($mappedRequest);
        self::assertEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals($key, $mappedRequest->requestLine()->requestUri());

        $key = '/moduleX/pageX/actionX/';
        $request = $this->createRequest($key, HttpMethod::POST());
        $mappedRequest = new MappedRequest($request, $routesMapping);
        $this->assertsRequestLine($mappedRequest);
        self::assertEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals($key, $mappedRequest->requestLine()->requestUri());

        $key = '/context-path/index';
        $request = $this->createRequest($key, HttpMethod::DELETE());
        $mappedRequest = new MappedRequest($request, $routesMapping);
        $this->assertsRequestLine($mappedRequest);
        self::assertNotEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('/moduleDef/controllerDef/actionDef/idDef', $mappedRequest->requestLine()->requestUri());

        $key = '/context-path/mod/ctrl';
        $request = $this->createRequest($key, HttpMethod::POST());
        $mappedRequest = new MappedRequest($request, $routesMapping);
        $this->assertsRequestLine($mappedRequest);
        self::assertNotEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('/moduleTest/controllerTest/actionTest/idTest', $mappedRequest->requestLine()->requestUri());

        $key = '/context-path/http/methods';
        $request = $this->createRequest($key, HttpMethod::GET());
        $mappedRequest = new MappedRequest($request, $routesMapping);
        $this->assertsRequestLine($mappedRequest);
        self::assertNotEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('/module/controller/getAction', $mappedRequest->requestLine()->requestUri());

        $key = '/context-path/http/methods';
        $request = $this->createRequest($key, HttpMethod::POST());
        $mappedRequest = new MappedRequest($request, $routesMapping);
        $this->assertsRequestLine($mappedRequest);
        self::assertNotEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('/module/controller/postAction', $mappedRequest->requestLine()->requestUri());

        $key = '/context-path/http/methods';
        $request = $this->createRequest($key, HttpMethod::PUT());
        $mappedRequest = new MappedRequest($request, $routesMapping);
        $this->assertsRequestLine($mappedRequest);
        self::assertNotEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('/module/controller/putAction', $mappedRequest->requestLine()->requestUri());

        $key = '/context-path/http/methods';
        $request = $this->createRequest($key, HttpMethod::PATCH());
        $mappedRequest = new MappedRequest($request, $routesMapping);
        $this->assertsRequestLine($mappedRequest);
        self::assertNotEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('/module/controller/patchAction', $mappedRequest->requestLine()->requestUri());

        $key = '/context-path/http/methods';
        $request = $this->createRequest($key, HttpMethod::DELETE());
        $mappedRequest = new MappedRequest($request, $routesMapping);
        $this->assertsRequestLine($mappedRequest);
        self::assertNotEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('/module/controller/deleteAction', $mappedRequest->requestLine()->requestUri());
    }

    public function testHeaders()
    {
        $request = $this->fakeRequest;
        $mappedRequest = new MappedRequest($request, $this->fakeRoutesMapping);
        self::assertNotNull($mappedRequest->headers());
        self::assertIsObject($mappedRequest->headers());
        self::assertEquals($request->headers(), $mappedRequest->headers());

        $request = $this->createRequest('/', HttpMethod::GET());
        $mappedRequest = new MappedRequest($request, $this->fakeRoutesMapping);
        self::assertNotNull($mappedRequest->headers());
        self::assertIsObject($mappedRequest->headers());
        self::assertEquals($request->headers(), $mappedRequest->headers());
    }

    public function testRequestData()
    {
        $request = $this->fakeRequest;
        $mappedRequest = new MappedRequest($request, $this->fakeRoutesMapping);
        self::assertNotNull($mappedRequest->requestData());
        self::assertIsObject($mappedRequest->requestData());
        self::assertEquals($request->requestData(), $mappedRequest->requestData());

        $request = $this->createRequest('/', HttpMethod::GET());
        $mappedRequest = new MappedRequest($request, $this->fakeRoutesMapping);
        self::assertNotNull($mappedRequest->requestData());
        self::assertIsObject($mappedRequest->requestData());
        self::assertEquals($request->requestData(), $mappedRequest->requestData());
    }

    /**
     * @param string $requestUri
     * @param HttpMethodEnum $method
     * @return Request
     */
    protected function createRequest(string $requestUri, HttpMethodEnum $method): Request
    {
        $requestLine = new RequestLine($method, $requestUri);
        return new Request($requestLine, new FakeRequestHeaders(), new FakeRequestData());
    }

    private function assertsRequestLine(MappedRequest $mappedRequest): void
    {
        self::assertNotNull($mappedRequest->requestLine());
        self::assertIsObject($mappedRequest->requestLine());
        self::assertNotEmpty($mappedRequest->requestLine()->requestUri());
        self::assertIsString($mappedRequest->requestLine()->requestUri());
    }
}
