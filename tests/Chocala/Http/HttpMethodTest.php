<?php

namespace Chocala\Http;

require_once __DIR__ . '/Parts/QueryParamsTest.php';

use Chocala\Http\Parts\Fakes\FakeQueryParams;
use Chocala\Http\Parts\QueryParams;
use Chocala\Http\Parts\QueryParamsInterface;
use Chocala\Http\Parts\RequestDataBody;
use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class HttpMethodTest extends TestCase
{

    protected function arrayQueryParams(): array
    {
        return FakeQueryParams::ARRAY_DATA;
    }

    protected function initQueryParams()
    {
        $_GET = $this->arrayQueryParams();
    }

    protected function textContent(): string
    {
        return 'Text plain content...';
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

    public function testQueryParams()
    {
        $httpMethod = $this->httpMethodCustomClass();
        $_GET = $this->arrayQueryParams();
        $size = sizeof($_GET);
        self::assertNotNull($httpMethod->queryParams());
        self::assertIsObject($httpMethod->queryParams());
        self::assertInstanceOf(QueryParamsInterface::class, $httpMethod->queryParams());
        self::assertCount($size, $httpMethod->queryParams()->data());
        unset($_GET['lastKey']);
        self::assertCount($size-1, $httpMethod->queryParams()->data());
    }

    public function testContent()
    {
        // Using $_REQUEST as the data source
        $httpMethod = $this->httpMethodCustomClass();
        //print_r($httpMethod);
        print_r("Printed object in -> " . __CLASS__ . "\n");
        print_r($httpMethod->content());
        $size = sizeof($this->arrayQueryParams());
        self::assertIsObject($httpMethod->content());
        self::assertNotEmpty($httpMethod->content()->data());
        self::assertCount($size, $httpMethod->content()->data());
        $_REQUEST['123'] = 123;
        self::assertCount($size + 1, $httpMethod->content()->data());
        self::assertEquals(123, $httpMethod->content()->data()['123']);
        unset($_REQUEST['lastKey']);
        self::assertCount($size, $httpMethod->content()->data());
    }

//    public function testHas()
//    {
//        $httpMethod = $this->httpMethodCustomClass();
//        self::assertIsBool($httpMethod->has('var0'));
//        self::assertIsBool($httpMethod->has('INVALID_KEY'));
//        self::assertTrue($httpMethod->has('var0'));
//        self::assertFalse($httpMethod->has('INVALID_KEY'));
//    }

//    public function testGet()
//    {
//        $httpMethod = $this->httpMethodCustomClass();
//        self::assertEquals('zero', $httpMethod->get('var0'));
//        self::assertIsNumeric($httpMethod->get('numericKey'));
//        self::assertIsArray($httpMethod->get('arrayKey'));
//        self::assertNull($httpMethod->get('nullKey'));
//        self::assertEquals('DEFAULT_VALUE', $httpMethod->get('DEFAULT_01234XYZ', 'DEFAULT_VALUE'));
//    }

//    public function testDelete()
//    {
//        $httpMethod = $this->httpMethodCustomClass();
//        $size = sizeof($this->arrayQueryParams());
//        self::assertCount($size, $httpMethod->data());
//        $httpMethod->delete('toRemoveKey');
//        self::assertCount($size - 1, $httpMethod->data());
//        self::assertEquals($httpMethod, $httpMethod->delete('INVALID_KEY'));
//        self::assertCount($size - 1, $httpMethod->data());
//    }

//    public function testExtract()
//    {
//        $httpMethod = $this->httpMethodCustomClass();
//        $size = sizeof($this->arrayQueryParams());
//        self::assertCount($size, $httpMethod->data());
//        self::assertEquals('extractedValue', $httpMethod->extract('extractedKey'));
//        self::assertCount($size - 1, $httpMethod->data());
//        self::assertNull($httpMethod->extract('INVALID_KEY'));
//        self::assertCount($size - 1, $httpMethod->data());
//    }

    private function httpMethodCustomClass(): HttpMethod
    {
        $httpMethod = new class() extends HttpMethod {
            use HttpMethodTrait;

            public function __construct()
            {
                $this->name = 'CUSTOM';
                $this->queryParams = new QueryParams();
                $this->messageBody = new RequestDataBody(ContentType::TEXT_HTML);
            }

        };
        $_REQUEST = $this->arrayQueryParams();
        return new $httpMethod();
    }

}
