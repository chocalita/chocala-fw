<?php

namespace Chocala\Http;

require_once __DIR__ . '/Parts/QueryParamsTest.php';

use Chocala\Http\Parts\QueryParamsTest;
use PHPUnit\Framework\TestCase;

class HttpMethodTest extends TestCase
{

    protected function arrayQueryParams(): array
    {
        return QueryParamsTest::ARRAY_VALUES;
    }

    protected function textContent(): string
    {
        return 'Text plain content...';
    }

    protected function htmlContent(): string
    {
        return '<h1>Title</h1><p>You got your HTML content for your test...</p>';
    }

    protected function jsonContent(): string
    {
        return '{
            "key": "value"
        }';
    }

    protected function arrayFormData(): array
    {
        return [
            'var0' => 'zero',
            'arrayKey' => [],
            'nullKey' => null,
            'toRemoveKey' => 'toRemoveValue',
            'extractedKey' => 'extractedValue',
            'lastKey' => 'last'
        ];
    }

    /**
     * @param array $input
     * @return string
     * Source: https://stackoverflow.com/a/11427592
     */
    protected function arrayToQueryString(array $input) : string
    {
        return implode('&', array_map(
            function ($v, $k) {
                if(is_array($v)){
                    return $k.'[]='.implode('&'.$k.'[]=', $v);
                }else{
                    return $k.'='.$v;
                }
            },
            $input,
            array_keys($input)
        ));
    }

    public function testName()
    {
        $httpMethod = $this->httpMethodCustomClass();
        self::assertIsObject($httpMethod);
        self::assertEquals('CUSTOM', $httpMethod->name());
    }

    public function testId()
    {
        $httpMethod = $this->httpMethodCustomClass();
        self::assertNotNull($httpMethod->id());
        self::assertGreaterThan(8, strlen($httpMethod->id()));
    }

    public function testData()
    {
        $httpMethod = $this->httpMethodCustomClass();
        $size = sizeof($this->arrayQueryParams());
        self::assertNotEmpty($httpMethod->data());
        self::assertCount($size, $httpMethod->data());
        $_REQUEST['123'] = 123;
        self::assertCount($size + 1, $httpMethod->data());
        self::assertEquals(123, $httpMethod->get('123'));
        unset($_REQUEST['lastKey']);
        self::assertCount($size, $httpMethod->data());
    }

    public function testHas()
    {
        $httpMethod = $this->httpMethodCustomClass();
        self::assertIsBool($httpMethod->has('var0'));
        self::assertIsBool($httpMethod->has('INVALID_KEY'));
        self::assertTrue($httpMethod->has('var0'));
        self::assertFalse($httpMethod->has('INVALID_KEY'));
    }

    public function testGet()
    {
        $httpMethod = $this->httpMethodCustomClass();
        self::assertNull($httpMethod->get('INVALID_KEY'));
        self::assertEquals('zero', $httpMethod->get('var0'));
        self::assertIsNumeric($httpMethod->get('numericKey'));
        self::assertIsArray($httpMethod->get('arrayKey'));
        self::assertNull($httpMethod->get('nullKey'));
        self::assertEquals('DEFAULT_VALUE', $httpMethod->get('DEFAULT_01234XYZ', 'DEFAULT_VALUE'));
    }

    public function testDelete()
    {
        $httpMethod = $this->httpMethodCustomClass();
        $size = sizeof($this->arrayQueryParams());
        self::assertCount($size, $httpMethod->data());
        $httpMethod->delete('toRemoveKey');
        self::assertCount($size - 1, $httpMethod->data());
        self::assertEquals($httpMethod, $httpMethod->delete('INVALID_KEY'));
        self::assertCount($size - 1, $httpMethod->data());
    }

    public function testExtract()
    {
        $httpMethod = $this->httpMethodCustomClass();
        $size = sizeof($this->arrayQueryParams());
        self::assertCount($size, $httpMethod->data());
        self::assertEquals('extractedValue', $httpMethod->extract('extractedKey'));
        self::assertCount($size - 1, $httpMethod->data());
        self::assertNull($httpMethod->extract('INVALID_KEY'));
        self::assertCount($size - 1, $httpMethod->data());
    }

    public function testBody()
    {
        $httpMethod = $this->httpMethodCustomClass();
        //TODO: create tests
        print_r($httpMethod->body());
        self::assertNull(null);
    }

    private function httpMethodCustomClass(): HttpMethod
    {
        $httpMethod = new class() extends HttpMethod {

            public function __construct()
            {
                $this->name = 'CUSTOM';
                $this->data = &$_REQUEST;
                $this->id = $this->generateId();
            }

        };
        $_REQUEST = $this->arrayQueryParams();
        return new $httpMethod();
    }

}
