<?php

namespace Chocala\Web\Result;

use Chocala\Base\IllegalArgumentException;
use Chocala\Base\NotFoundException;
use Chocala\Http\Headers;
use Exception;
use PHPUnit\Framework\TestCase;

class ResultHeadersTest extends TestCase
{

    /**
     * @var array
     */
    private array $defaultHeadersList;

    /**
     * @var ResultHeaders
     */
    private ResultHeaders $defaultResultHeaders;

    public function setUp()
    {
        $this->defaultHeadersList = $this->customHeadersList();
        $this->defaultResultHeaders = new ResultHeaders($this->defaultHeadersList);
    }

    public function test__construct()
    {
        $headers = new ResultHeaders($this->defaultHeadersList);
        self::assertIsObject($headers);

        $headers = new ResultHeaders();
        self::assertIsObject($headers);
    }

    public function testHeaderList()
    {
        $headersList = $this->defaultHeadersList;
        $headers = $this->defaultResultHeaders;
        self::assertIsArray($headers->headerList());
        self::assertSameSize($headersList, $headers->headerList());
        self::assertEquals($headersList, $headers->headerList());
    }

    public function testHeadersType()
    {
        $headers = $this->defaultResultHeaders;

        $headersType = $headers->headersType(Headers::TYPE_GENERAL);
        self::assertIsArray($headersType);
        self::assertEmpty($headersType);

        $headersType = $headers->headersType(Headers::TYPE_ENTITY);
        self::assertIsArray($headersType);
        self::assertEmpty($headersType);

        $headersType = $headers->headersType(Headers::TYPE_RESPONSE);
        self::assertIsArray($headersType);
        self::assertEmpty($headersType);

        $headersType = $headers->headersType(Headers::TYPE_CUSTOM);
        self::assertIsArray($headersType);
        self::assertNotEmpty($headersType);
        self::assertCount(3, $headersType);
        self::assertArrayHasKey('client', $headersType);

        $this->expectException(IllegalArgumentException::class);
        $headers->headersType(Headers::TYPE_REQUEST);
    }

    public function testHeader()
    {
        $headersList = $this->defaultHeadersList;
        $headers = $this->defaultResultHeaders;

        // Headers with names defined in constants
        try {
            $headers->header(Headers::CACHE_CONTROL_KEY);
            self::fail();
        } catch (NotFoundException $e) {
            self::assertTrue(true);
        }
        try {
            $headers->header(Headers::ALLOW_KEY);
            self::fail();
        } catch (NotFoundException $e) {
            self::assertTrue(true);
        }

        // A Request header as a Custom header
        try {
            $headers->header(Headers::ACCEPT_KEY);
            self::fail();
        } catch (NotFoundException $e) {
            self::assertTrue(true);
        }

        // Custom Headers
        self::assertNotEmpty($headers->header('key'));
        self::assertEquals($headersList['key'], $headers->header('key'));
        self::assertNotEmpty($headers->header('client'));
        self::assertEquals($headersList['client'], $headers->header('client'));
        self::assertNotEmpty($headers->header('token'));
        self::assertEquals($headersList['token'], $headers->header('token'));

        foreach (Headers::RESPONSE_KEYS as $headerKey) {
            $headersList[$headerKey] = $headerKey;
            try {
                $headers->header($headerKey);
                self::fail();
            } catch (NotFoundException $e) {
                self::assertTrue(true);
            }
        }

        $this->expectException(NotFoundException::class);
        $headers->header('123UndefinedKey');
    }

    public function testAddHeader()
    {
        $headersList = $this->defaultHeadersList;
        $headers = $this->defaultResultHeaders;
        self::assertIsArray($headers->headerList());
        self::assertSameSize($headersList, $headers->headerList());
        self::assertEquals($headersList, $headers->headerList());

        try {
            $headers->addHeader('xyz', 'letters');
            self::assertTrue(true);
            self::assertNotSameSize($headersList, $headers->headerList());
            self::assertArrayHasKey('xyz', $headers->headerList());
        } catch (Exception $e) {
            self::fail();
        }
    }

    private function customHeadersList(): array
    {
        return [
            // Custom Headers
            'key' => 'namedKey',
            'client' => '20200411',
            'token' => 'TgU02iSTwe73eRh'
        ];
    }

}