<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\Base\NotFoundException;
use PHPUnit\Framework\TestCase;
use TypeError;

class ResponseHeadersTest extends TestCase
{

    /**
     * @var array
     */
    private $defaultHeadersList;

    /**
     * @var Headers
     */
    private $defaultResponseHeaders;

    public function setUp()
    {
        $this->defaultHeadersList = $this->customHeadersList();
        $this->defaultResponseHeaders = new ResponseHeaders($this->defaultHeadersList);
    }

    public function test__construct()
    {
        $headers = new ResponseHeaders($this->defaultHeadersList);
        self::assertIsObject($headers);
        $this->expectException(TypeError::class);
        new ResponseHeaders();
    }

    public function testHeaderList()
    {
        $headersList = $this->defaultHeadersList;
        $headers = $this->defaultResponseHeaders;
        self::assertIsArray($headers->headerList());
        self::assertSameSize($headersList, $headers->headerList());
        self::assertEquals($headersList, $headers->headerList());
    }

    public function testHeadersType()
    {
        $headers = $this->defaultResponseHeaders;

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

        $headersType = $headers->headersType(Headers::TYPE_RESPONSE);
        self::assertIsArray($headersType);
        self::assertNotEmpty($headersType);
        self::assertArrayHasKey(Headers::ACCEPT_RANGES_KEY, $headersType);
        self::assertSameSize(Headers::RESPONSE_KEYS, $headersType);

        $headersType = $headers->headersType(Headers::TYPE_CUSTOM);
        self::assertIsArray($headersType);
        self::assertNotEmpty($headersType);
        self::assertCount(4, $headersType);
        self::assertArrayHasKey('client', $headersType);

        $this->expectException(IllegalArgumentException::class);
        $headers->headersType(Headers::TYPE_REQUEST);
    }

    public function testHeader()
    {
        $headersList = $this->defaultHeadersList;
        $headers = $this->defaultResponseHeaders;

        // Headers with names defined in constants
        self::assertEquals('Cache-Control', $headers->header(Headers::CACHE_CONTROL_KEY));
        self::assertEquals('Allow', $headers->header(Headers::ALLOW_KEY));

        // A Request header as a Custom header
        self::assertNotNull($headers->header(Headers::ACCEPT_KEY));
        self::assertEquals('Accept', $headers->header(Headers::ACCEPT_KEY));

        // Custom Headers
        self::assertNotEmpty($headers->header('key'));
        self::assertEquals($headersList['key'], $headers->header('key'));
        self::assertNotEmpty($headers->header('client'));
        self::assertEquals($headersList['client'], $headers->header('client'));
        self::assertNotEmpty($headers->header('token'));
        self::assertEquals($headersList['token'], $headers->header('token'));

        foreach (Headers::RESPONSE_KEYS as $headerKey) {
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
            // Another Request header as a Custom key
            'Accept-Charset' => 'utf-8'
        ];

        // Default official headers keys
        $headers = new ResponseHeaders($headersList);
        $headersType = $headers->headersType(Headers::TYPE_CUSTOM);
        self::assertIsArray($headersType);
        self::assertNotEmpty($headersType);
        self::assertCount(2, $headersType);
        self::assertArrayHasKey('Accept', $headersType);
        self::assertArrayHasKey('Accept-Charset', $headersType);
    }

    private function customHeadersList()
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
        foreach (Headers::RESPONSE_KEYS as $headerKey) {
            $headersList[$headerKey] = $headerKey;
        }
        return $headersList;
    }

}
