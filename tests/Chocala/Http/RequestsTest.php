<?php

namespace Http;

use Chocala\Http\HttpMethod;
use Chocala\Http\Request\Parts\RequestData;
use Chocala\Http\Request\Parts\RequestDataNoBody;
use Chocala\Http\Request\Parts\RequestHeadersInterface;
use Chocala\Http\Request\Request;
use Chocala\Http\RequestInterface;
use Chocala\Http\Requests;
use PHPUnit\Framework\TestCase;

class RequestsTest extends TestCase
{
    private Requests $requests;

    private array $serverVars = [
        'HTTP_ACCEPT_LANGUAGE' => 'en-419,en;q=0.9',
        'HTTP_CACHE_CONTROL' => 'max-age=0',
        'HTTP_CONNECTION' => 'keep-alive',
        'HTTP_REFERER' => 'http://localhost/tests/',
        'HTTP_SEC_FETCH_SITE' => 'same-origin',
        'CONTENT_TYPE' => 'text/html',
        'HTTP_USER_AGENT' => 'PostmanRuntime/7.36.0',
        'HTTP_HOST' => 'localhost',
        'HTTP_ACCEPT_ENCODING' => 'gzip, deflate, br',
        'SERVER_NAME' => 'localhost',
        'SERVER_ADDR' => '::1',
        'SERVER_PORT' => '80',
        'REMOTE_ADDR' => '::1',
        'REQUEST_SCHEME' => 'http',
        'CONTEXT_DOCUMENT_ROOT' => '/home/path/files/',
        'SCRIPT_FILENAME' => '/home/path/files/to/test-file.php',
        'SERVER_PROTOCOL' => 'HTTP/1.1',
        'REQUEST_METHOD' => 'POST',
        'QUERY_STRING' => 'var0=orange&var1=2&varX=inUrl',
        'REQUEST_URI' => '/tests/testControl/testAction/10?params=true',
        'SCRIPT_NAME' => '/to/test-file.php'
    ];

    private function initializeSERVER()
    {
        foreach ($this->serverVars as $k => $v) {
            $_SERVER[$k] = $v;
        }
    }

    public function setUp()
    {
        $this->requests = new Requests();
    }

    public function test__construct()
    {
        $object = new Requests();
        self::assertNotNull($object);
        self::assertIsObject($object);
        self::assertInstanceOf(Requests::class, $object);
        self::assertObjectHasAttribute('serverVars', $object);

        self::assertNotNull($this->requests);
        self::assertIsObject($this->requests);
        self::assertInstanceOf(Requests::class, $this->requests);
    }

    public function testMake()
    {
        $this->initializeSERVER();
        $request = $this->requests->make();
        self::assertNotNull($request);
        self::assertIsObject($request);
        self::assertInstanceOf(RequestInterface::class, $request);
        self::assertInstanceOf(Request::class, $request);

        self::assertIsObject($request->requestLine());
        self::assertIsObject($request->headers());
        self::assertIsObject($request->requestData());
    }

    public function testMakeNoBody()
    {
        $this->initializeSERVER();
        foreach (HttpMethod::all() as $httpMethod) {
            if ($httpMethod->isSafe()) {
                $_SERVER['REQUEST_METHOD'] = $httpMethod;
                $request = $this->requests->make();
                self::assertNotNull($request);
                self::assertIsObject($request);
                self::assertInstanceOf(RequestInterface::class, $request);
                self::assertInstanceOf(Request::class, $request);

                self::assertIsObject($request->requestLine());
                self::assertIsObject($request->headers());
                self::assertIsObject($request->requestData());

                self::assertEquals($httpMethod, $request->requestLine()->method());
                self::assertInstanceOf(RequestHeadersInterface::class, $request->headers());
                self::assertInstanceOf(RequestDataNoBody::class, $request->requestData());
            }
        }
    }

    public function testMakeWithBody()
    {
        $this->initializeSERVER();
        foreach (HttpMethod::all() as $httpMethod) {
            if (!$httpMethod->isSafe()) {
                $_SERVER['REQUEST_METHOD'] = $httpMethod;
                $request = $this->requests->make();
                self::assertNotNull($request);
                self::assertIsObject($request);
                self::assertInstanceOf(RequestInterface::class, $request);
                self::assertInstanceOf(Request::class, $request);

                self::assertIsObject($request->requestLine());
                self::assertIsObject($request->headers());
                self::assertIsObject($request->requestData());

                self::assertEquals($httpMethod, $request->requestLine()->method());
                self::assertInstanceOf(RequestHeadersInterface::class, $request->headers());
                self::assertInstanceOf(RequestData::class, $request->requestData());
            }
        }
    }
}
