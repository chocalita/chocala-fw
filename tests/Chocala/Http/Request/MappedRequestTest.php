<?php

namespace Chocala\Http\Request;

use ArgumentCountError;
use Chocala\Http\Fakes\FakeRequest;
use Chocala\Http\Mapping\Fakes\FakeUriMapping;
use Chocala\Http\Mapping\UriMapping;
use Chocala\Http\Parts\Fakes\FakeHeaders;
use Chocala\Http\Parts\Fakes\FakeMessageBody;
use Chocala\Http\Parts\RequestLine;
use Chocala\Http\RequestInterface;
use Chocala\Http\Route\DefaultRoutes;
use Chocala\Http\Route\Fakes\FakeRoutes;
use PHPUnit\Framework\TestCase;

class MappedRequestTest extends TestCase
{

    /**
     * @var FakeHeaders
     */
    private $fakeHeaders;

    /**
     * @var FakeMessageBody
     */
    private $fakeMessageBody;

    /**
     * @var DefaultRoutes
     */
    private $defaultRoutes;

    /**
     * @var FakeRoutes
     */
    private $fakeRoutes;

    public function setUp()
    {
        $this->fakeHeaders = new FakeHeaders();
        $this->fakeMessageBody = new FakeMessageBody();
        $this->defaultRoutes = new DefaultRoutes();
        $this->fakeRoutes = new FakeRoutes();
    }

    public function test__construct()
    {
        $mappedRequest = new MappedRequest(new FakeRequest(), new FakeUriMapping());
        self::assertNotEmpty($mappedRequest);
        self::assertIsObject($mappedRequest);
        self::assertInstanceOf(RequestInterface::class, $mappedRequest);
        self::assertInstanceOf(MappedRequest::class, $mappedRequest);

        $this->expectException(ArgumentCountError::class);
        new MappedRequest();
    }

    public function testRequestLine()
    {
        $request = new FakeRequest();
        // FakeUriMapping always this returns the same 'requestUri' as the original request
        $mappedRequest = new MappedRequest($request, new FakeUriMapping());
        self::assertNotNull($mappedRequest->requestLine());
        self::assertIsObject($mappedRequest->requestLine());
        self::assertNotEmpty($mappedRequest->requestLine()->requestUri());
        self::assertIsString($mappedRequest->requestLine()->requestUri());
        self::assertNotEquals($request->requestLine(), $mappedRequest->requestLine());
        self::assertEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());

        // Request object returns the same 'requestUri' as the original request
        $request = $this->createRequest('/', 'GET');
        $mappedRequest = new MappedRequest($request, new FakeUriMapping());
        self::assertNotNull($mappedRequest->requestLine());
        self::assertIsObject($mappedRequest->requestLine());
        self::assertNotEmpty($mappedRequest->requestLine()->requestUri());
        self::assertIsString($mappedRequest->requestLine()->requestUri());
        self::assertEquals($request->requestLine(), $mappedRequest->requestLine());
        self::assertEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());

        // UriMapping applying DefaultRoutes routing

        $request = $this->createRequest('', 'GET');
        $mappedRequest = new MappedRequest($request, new UriMapping($this->defaultRoutes));
        self::assertNotNull($mappedRequest->requestLine());
        self::assertIsObject($mappedRequest->requestLine());
        self::assertEmpty($mappedRequest->requestLine()->requestUri());
        self::assertIsString($mappedRequest->requestLine()->requestUri());
        self::assertEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('', $mappedRequest->requestLine()->requestUri());

        $request = $this->createRequest('/', 'GET');
        $mappedRequest = new MappedRequest($request, new UriMapping($this->defaultRoutes));
        self::assertNotNull($mappedRequest->requestLine());
        self::assertIsObject($mappedRequest->requestLine());
        self::assertNotEmpty($mappedRequest->requestLine()->requestUri());
        self::assertIsString($mappedRequest->requestLine()->requestUri());
        self::assertNotEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('/main/system/index', $mappedRequest->requestLine()->requestUri());

        $request = $this->createRequest('/contact', 'GET');
        $mappedRequest = new MappedRequest($request, new UriMapping($this->defaultRoutes));
        self::assertNotNull($mappedRequest->requestLine());
        self::assertIsObject($mappedRequest->requestLine());
        self::assertNotEmpty($mappedRequest->requestLine()->requestUri());
        self::assertIsString($mappedRequest->requestLine()->requestUri());
        self::assertNotEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('/main/system/contact', $mappedRequest->requestLine()->requestUri());
    }

    public function testRequestLineMapped()
    {
        $uriMapping = new UriMapping($this->fakeRoutes);

        $key = '/context-module/page/action/ID';
        $request = $this->createRequest($key, 'GET');
        $mappedRequest = new MappedRequest($request, $uriMapping);
        self::assertNotNull($mappedRequest->requestLine());
        self::assertIsObject($mappedRequest->requestLine());
        self::assertNotEmpty($mappedRequest->requestLine()->requestUri());
        self::assertIsString($mappedRequest->requestLine()->requestUri());
        self::assertEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals($key, $mappedRequest->requestLine()->requestUri());

        $key = '/moduleX/pageX/actionX/99';
        $request = $this->createRequest($key, 'POST');
        $mappedRequest = new MappedRequest($request, $uriMapping);
        self::assertNotNull($mappedRequest->requestLine());
        self::assertIsObject($mappedRequest->requestLine());
        self::assertNotEmpty($mappedRequest->requestLine()->requestUri());
        self::assertIsString($mappedRequest->requestLine()->requestUri());
        self::assertEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals($key, $mappedRequest->requestLine()->requestUri());

        $key = '/moduleX/pageX/actionX/';
        $request = $this->createRequest($key, 'POST');
        $mappedRequest = new MappedRequest($request, $uriMapping);
        self::assertNotNull($mappedRequest->requestLine());
        self::assertIsObject($mappedRequest->requestLine());
        self::assertNotEmpty($mappedRequest->requestLine()->requestUri());
        self::assertIsString($mappedRequest->requestLine()->requestUri());
        self::assertEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals($key, $mappedRequest->requestLine()->requestUri());

        $key = '/context-path/index';
        $request = $this->createRequest($key, 'DELETE');
        $mappedRequest = new MappedRequest($request, $uriMapping);
        self::assertNotNull($mappedRequest->requestLine());
        self::assertIsObject($mappedRequest->requestLine());
        self::assertNotEmpty($mappedRequest->requestLine()->requestUri());
        self::assertIsString($mappedRequest->requestLine()->requestUri());
        self::assertNotEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('/moduleDef/controllerDef/actionDef/idDef', $mappedRequest->requestLine()->requestUri());

        $key = '/context-path/mod/ctrl';
        $request = $this->createRequest($key, 'POST');
        $mappedRequest = new MappedRequest($request, $uriMapping);
        self::assertNotNull($mappedRequest->requestLine());
        self::assertIsObject($mappedRequest->requestLine());
        self::assertNotEmpty($mappedRequest->requestLine()->requestUri());
        self::assertIsString($mappedRequest->requestLine()->requestUri());
        self::assertNotEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('/moduleTest/controllerTest/actionTest/idTest', $mappedRequest->requestLine()->requestUri());

        $key = '/context-path/http/methods';
        $request = $this->createRequest($key, 'GET');
        $mappedRequest = new MappedRequest($request, $uriMapping);
        self::assertNotNull($mappedRequest->requestLine());
        self::assertIsObject($mappedRequest->requestLine());
        self::assertNotEmpty($mappedRequest->requestLine()->requestUri());
        self::assertIsString($mappedRequest->requestLine()->requestUri());
        self::assertNotEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('/module/controller/getAction', $mappedRequest->requestLine()->requestUri());

        $key = '/context-path/http/methods';
        $request = $this->createRequest($key, 'POST');
        $mappedRequest = new MappedRequest($request, $uriMapping);
        self::assertNotNull($mappedRequest->requestLine());
        self::assertIsObject($mappedRequest->requestLine());
        self::assertNotEmpty($mappedRequest->requestLine()->requestUri());
        self::assertIsString($mappedRequest->requestLine()->requestUri());
        self::assertNotEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('/module/controller/postAction', $mappedRequest->requestLine()->requestUri());

        $key = '/context-path/http/methods';
        $request = $this->createRequest($key, 'PUT');
        $mappedRequest = new MappedRequest($request, $uriMapping);
        self::assertNotNull($mappedRequest->requestLine());
        self::assertIsObject($mappedRequest->requestLine());
        self::assertNotEmpty($mappedRequest->requestLine()->requestUri());
        self::assertIsString($mappedRequest->requestLine()->requestUri());
        self::assertNotEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('/module/controller/putAction', $mappedRequest->requestLine()->requestUri());

        $key = '/context-path/http/methods';
        $request = $this->createRequest($key, 'PATCH');
        $mappedRequest = new MappedRequest($request, $uriMapping);
        self::assertNotNull($mappedRequest->requestLine());
        self::assertIsObject($mappedRequest->requestLine());
        self::assertNotEmpty($mappedRequest->requestLine()->requestUri());
        self::assertIsString($mappedRequest->requestLine()->requestUri());
        self::assertNotEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('/module/controller/patchAction', $mappedRequest->requestLine()->requestUri());

        $key = '/context-path/http/methods';
        $request = $this->createRequest($key, 'DELETE');
        $mappedRequest = new MappedRequest($request, $uriMapping);
        self::assertNotNull($mappedRequest->requestLine());
        self::assertIsObject($mappedRequest->requestLine());
        self::assertNotEmpty($mappedRequest->requestLine()->requestUri());
        self::assertIsString($mappedRequest->requestLine()->requestUri());
        self::assertNotEquals($request->requestLine()->requestUri(), $mappedRequest->requestLine()->requestUri());
        self::assertEquals('/module/controller/deleteAction', $mappedRequest->requestLine()->requestUri());
    }

    public function testHeaders()
    {
        $request = new FakeRequest();
        $mappedRequest = new MappedRequest($request, new FakeUriMapping());
        self::assertNotNull($mappedRequest->headers());
        self::assertIsObject($mappedRequest->headers());
        self::assertEquals($request->headers(), $mappedRequest->headers());

        $request = $this->createRequest('/', 'GET');
        $mappedRequest = new MappedRequest($request, new FakeUriMapping());
        self::assertNotNull($mappedRequest->headers());
        self::assertIsObject($mappedRequest->headers());
        self::assertEquals($request->headers(), $mappedRequest->headers());
    }

    public function testMessageBody()
    {
        $request = new FakeRequest();
        $mappedRequest = new MappedRequest($request, new FakeUriMapping());
        self::assertNotNull($mappedRequest->messageBody());
        self::assertIsObject($mappedRequest->messageBody());
        self::assertEquals($request->messageBody(), $mappedRequest->messageBody());

        $request = $this->createRequest('/', 'GET');
        $mappedRequest = new MappedRequest($request, new FakeUriMapping());
        self::assertNotNull($mappedRequest->messageBody());
        self::assertIsObject($mappedRequest->messageBody());
        self::assertEquals($request->messageBody(), $mappedRequest->messageBody());
    }

    /**
     * @param string $requestUri
     * @param string $method
     * @return Request
     */
    protected function createRequest(string $requestUri, string $method) : Request
    {
        $requestLine = new RequestLine($method, $requestUri, 'HTTP/1.1');
        return new Request($requestLine, $this->fakeHeaders, $this->fakeMessageBody);
    }

}
