<?php

namespace Chocala\Http\Request\Parts;

use ArgumentCountError;
use Chocala\Base\IllegalArgumentException;
use Chocala\Base\NotFoundException;
use Chocala\Http\Headers;
use PHPUnit\Framework\TestCase;

class RequestHeadersTest extends TestCase
{
    /**
     * @var array
     */
    private array $defaultHeadersList;

    /**
     * @var RequestHeaders Headers
     */
    private RequestHeaders $defaultRequestHeaders;

    public function setUp()
    {
        $this->defaultHeadersList = $this->customHeadersList();
        $this->defaultRequestHeaders = new RequestHeaders($this->defaultHeadersList);
    }

    public function test__construct()
    {
        $headers = new RequestHeaders($this->defaultHeadersList);
        self::assertIsObject($headers);

        $this->expectException(ArgumentCountError::class);
        new RequestHeaders();
    }

    public function testHeaderList()
    {
        $headersList = $this->defaultHeadersList;
        $headers = $this->defaultRequestHeaders;
        self::assertIsArray($headers->headerList());
        self::assertSameSize($headersList, $headers->headerList());
        self::assertEquals($headersList, $headers->headerList());
    }

    public function testHeadersType()
    {
        $headers = $this->defaultRequestHeaders;

        $headersType = $headers->headersType(Headers::TYPE_GENERAL);
        self::assertIsArray($headersType);
        self::assertNotEmpty($headersType);
        self::assertArrayHasKey(Headers::CACHE_CONTROL_KEY, $headersType);
        self::assertCount(1, $headersType);

        $headersType = $headers->headersType(Headers::TYPE_ENTITY);
        self::assertIsArray($headersType);
        self::assertNotEmpty($headersType);
        self::assertArrayHasKey(Headers::ALLOW_KEY, $headersType);
        self::assertCount(1, $headersType);

        $headersType = $headers->headersType(Headers::TYPE_REQUEST);
        self::assertIsArray($headersType);
        self::assertNotEmpty($headersType);
        self::assertArrayHasKey(Headers::ACCEPT_KEY, $headersType);
        self::assertSameSize(Headers::REQUEST_KEYS, $headersType);

        $headersType = $headers->headersType(Headers::TYPE_CUSTOM);
        self::assertIsArray($headersType);
        self::assertNotEmpty($headersType);
        self::assertCount(4, $headersType);
        self::assertArrayHasKey('client', $headersType);

        $this->expectException(IllegalArgumentException::class);
        $headers->headersType(Headers::TYPE_RESPONSE);
    }

    public function testHeader()
    {
        $headersList = $this->defaultHeadersList;
        $headers = $this->defaultRequestHeaders;

        // Headers with names defined in constants
        self::assertEquals('Cache-Control', $headers->header(Headers::CACHE_CONTROL_KEY));
        self::assertEquals('Allow', $headers->header(Headers::ALLOW_KEY));

        // A Response header as a Custom header
        self::assertNotNull($headers->header(Headers::ACCEPT_RANGES_KEY));
        self::assertEquals('Accept-Ranges', $headers->header(Headers::ACCEPT_RANGES_KEY));

        // Custom Headers
        self::assertNotEmpty($headers->header('key'));
        self::assertEquals($headersList['key'], $headers->header('key'));
        self::assertNotEmpty($headers->header('client'));
        self::assertEquals($headersList['client'], $headers->header('client'));
        self::assertNotEmpty($headers->header('token'));
        self::assertEquals($headersList['token'], $headers->header('token'));

        foreach (Headers::REQUEST_KEYS as $headerKey) {
            $headersList[$headerKey] = $headerKey;
            self::assertNotEmpty($headers->header($headerKey));
            self::assertEquals($headersList[$headerKey], $headers->header($headerKey));
        }

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
            // Another Response header as a Custom key
            'AGE' => '2020'
        ];

        // Default official headers keys
        $headers = new RequestHeaders($headersList);
        $headersType = $headers->headersType(Headers::TYPE_CUSTOM);
        self::assertIsArray($headersType);
        self::assertNotEmpty($headersType);
        self::assertCount(2, $headersType);
        self::assertArrayHasKey('Accept-Ranges', $headersType);
        self::assertArrayHasKey('AGE', $headersType);
    }

    private function customHeadersList(): array
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
        foreach (Headers::REQUEST_KEYS as $headerKey) {
            $headersList[$headerKey] = $headerKey;
        }
        return $headersList;
    }
}
