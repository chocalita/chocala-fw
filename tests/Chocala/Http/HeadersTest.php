<?php

namespace Chocala\Http;

use Chocala\Base\NotFoundException;
use PHPUnit\Framework\TestCase;
use TypeError;

class HeadersTest extends TestCase
{
    /**
     * @var array
     */
    private array $defaultHeadersList;

    /**
     * @var Headers
     */
    private Headers $defaultHeaders;

    public function setUp()
    {
        $this->defaultHeadersList = $this->customHeadersList();
        $this->defaultHeaders = new Headers($this->defaultHeadersList);
    }

    public function test__construct()
    {
        $headers = new Headers($this->defaultHeadersList);
        self::assertIsObject($headers);
        $headers = new Headers($this->defaultHeadersList, null);
        self::assertIsObject($headers);
        $headers = new Headers($this->defaultHeadersList, []);
        self::assertIsObject($headers);
        $this->expectException(TypeError::class);
        new Headers([], 0);
        $this->getExpectedException();
    }

    public function testHeaderList()
    {
        $headers = $this->defaultHeaders;
        self::assertIsArray($headers->headerList());
        self::assertSameSize($this->defaultHeadersList, $headers->headerList());
        self::assertEquals($this->defaultHeadersList, $headers->headerList());
    }

    public function testHeadersType()
    {
        $headers = $this->defaultHeaders;

        $headersType = $headers->headersType(Headers::TYPE_GENERAL);
        self::assertIsArray($headersType);
        self::assertNotEmpty($headersType);
        self::assertArrayHasKey(Headers::CACHE_CONTROL_KEY, $headersType);

        $headersType = $headers->headersType(Headers::TYPE_ENTITY);
        self::assertIsArray($headersType);
        self::assertNotEmpty($headersType);
        self::assertArrayHasKey(Headers::ALLOW_KEY, $headersType);

        $headersType = $headers->headersType(Headers::TYPE_REQUEST);
        self::assertIsArray($headersType);
        self::assertNotEmpty($headersType);
        self::assertArrayHasKey(Headers::ACCEPT_KEY, $headersType);

        $headersType = $headers->headersType(Headers::TYPE_RESPONSE);
        self::assertIsArray($headersType);
        self::assertNotEmpty($headersType);
        self::assertArrayHasKey(Headers::ACCEPT_RANGES_KEY, $headersType);

        $headersType = $headers->headersType(Headers::TYPE_CUSTOM);
        self::assertIsArray($headersType);
        self::assertNotEmpty($headersType);
        self::assertArrayHasKey('client', $headersType);
        self::assertCount(3, $headersType);
    }

    public function testHeader()
    {
        $headersList = $this->defaultHeadersList;
        $headers = $this->defaultHeaders;

        // Headers with names defined in constants
        self::assertEquals('application/json', $headers->header(Headers::CONTENT_TYPE_KEY));
        self::assertEquals('Mozilla/5.0', $headers->header(Headers::USER_AGENT_KEY));
        self::assertEquals('en-US;q=0.9', $headers->header(Headers::ACCEPT_LANGUAGE_KEY));

        // Headers declared with manual writing names
        self::assertNotNull($headers->header(Headers::EXPIRES_KEY));
        self::assertEquals('0', $headers->header(Headers::EXPIRES_KEY));
        self::assertEquals(0, $headers->header(Headers::EXPIRES_KEY));
        self::assertNotNull($headers->header(Headers::ACCEPT_KEY));
        self::assertEquals('text/html', $headers->header(Headers::ACCEPT_KEY));
        self::assertNotNull($headers->header(Headers::CONNECTION_KEY));
        self::assertEquals('keep-alive', $headers->header(Headers::CONNECTION_KEY));
        self::assertNotNull($headers->header(Headers::PRAGMA_KEY));
        self::assertEquals('no-cache', $headers->header(Headers::PRAGMA_KEY));
        self::assertNotNull($headers->header(Headers::LAST_MODIFIED_KEY));
        self::assertStringContainsString(date('Y'), $headers->header(Headers::LAST_MODIFIED_KEY));

        // Headers with manual writing parameter
        self::assertNotEmpty($headers->header('connection'));
        self::assertEquals('keep-alive', $headers->header('connection'));
        self::assertNotEmpty($headers->header('content-type'));
        self::assertEquals('application/json', $headers->header('content-type'));
        - self::assertNotEmpty($headers->header('praGma'));
        self::assertEquals('no-cache', $headers->header('praGma'));

        // Custom Headers
        self::assertNotEmpty($headers->header('key'));
        self::assertEquals($headersList['key'], $headers->header('key'));
        self::assertNotEmpty($headers->header('client'));
        self::assertEquals($headersList['client'], $headers->header('client'));
        self::assertNotEmpty($headers->header('token'));
        self::assertEquals($headersList['token'], $headers->header('token'));

        // Undefined header
        $this->expectException(NotFoundException::class);
        $headers->header('123UndefinedKey');
    }

    public function testCustomHeaders()
    {
        $headersList = [
            // One header by type
            Headers::CACHE_CONTROL_KEY => 'Cache-Control',
            Headers::ALLOW_KEY => 'Allow',
            Headers::ACCEPT_KEY => 'Accept',
            Headers::ACCEPT_RANGES_KEY => 'Accept-Ranges',
            // Custom Headers
            'key' => 'namedKey',
            'client' => '20200411',
            'token' => 'TgU02iSTwe73eRh'
        ];

        // Default official headers keys
        $headers = new Headers($headersList);
        $headersType = $headers->headersType(Headers::TYPE_CUSTOM);
        self::assertIsArray($headersType);
        self::assertNotEmpty($headersType);
        self::assertCount(3, $headersType);
        self::assertArrayHasKey('client', $headersType);

        // Empty official headers keys
        $headers = new Headers($headersList, []);
        $headersType = $headers->headersType(Headers::TYPE_CUSTOM);
        self::assertIsArray($headersType);
        self::assertNotEmpty($headersType);
        self::assertCount(7, $headersType);
        self::assertArrayHasKey('client', $headersType);
        self::assertArrayHasKey(Headers::CACHE_CONTROL_KEY, $headersType);
        self::assertArrayHasKey(Headers::ALLOW_KEY, $headersType);
        self::assertArrayHasKey(Headers::ACCEPT_KEY, $headersType);
        self::assertArrayHasKey(Headers::ACCEPT_RANGES_KEY, $headersType);

        // Custom official headers keys
        $headers = new Headers($headersList, array_merge(Headers::REQUEST_KEYS, Headers::RESPONSE_KEYS));
        $headersType = $headers->headersType(Headers::TYPE_CUSTOM);
        self::assertIsArray($headersType);
        self::assertNotEmpty($headersType);
        self::assertCount(5, $headersType);
        self::assertArrayHasKey('client', $headersType);
        self::assertArrayHasKey(Headers::CACHE_CONTROL_KEY, $headersType);
        self::assertArrayHasKey(Headers::ALLOW_KEY, $headersType);
    }

    private function customHeadersList(): array
    {
        return [
            // One header by type
            Headers::CACHE_CONTROL_KEY => 'Cache-Control',
            Headers::ALLOW_KEY => 'Allow',
            Headers::ACCEPT_KEY => 'Accept',
            Headers::ACCEPT_RANGES_KEY => 'Accept-Ranges',

            // Headers declared with names defined in constants
            Headers::CONTENT_TYPE_KEY => 'application/json',
            Headers::USER_AGENT_KEY => 'Mozilla/5.0',
            Headers::ACCEPT_LANGUAGE_KEY => 'en-US;q=0.9',

            // Headers declared with manual writing names
            'Expires' => 0,
            'accept' => 'text/html',
            'CONNECTION' => 'keep-alive',
            'pragmA' => 'no-cache',
            'Last-Modified' => gmdate('D, d M Y H:i:s') . ' GMT',

            // Custom Headers
            'key' => 'namedKey',
            'client' => '20200411',
            'token' => 'TgU02iSTwe73eRh'
        ];
    }
}
