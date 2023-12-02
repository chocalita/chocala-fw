<?php

namespace Chocala\Http\Parts;

use Chocala\Http\HttpMethodInterface;
use Chocala\Http\Method\HttpMethodTrait;
use Chocala\Http\Parts\Fakes\FakeQueryParams;
use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class CustomRequestContentTest extends TestCase
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

    public function testBody()
    {
        $httpMethod = $this->httpMethodCustomClass();
        //print_r($httpMethod);
        print_r("Printed object in -> " . __CLASS__ . "\n");
        print_r($httpMethod->body());
        self::assertNotNull($httpMethod->body());
        self::assertIsObject($httpMethod->body());
        self::assertInstanceOf(MessageBodyInterface::class, $httpMethod->body());
        self::assertInstanceOf(RequestInBody::class, $httpMethod->body());

    }
    public function testData()
    {
        // Using $_REQUEST as the data source
        $httpMethod = $this->httpMethodCustomClass();
        $size = sizeof($this->arrayQueryParams());
        self::assertNotEmpty($httpMethod->body()->data());
        self::assertCount($size, $httpMethod->body()->data());
        $_REQUEST['123'] = 123;
        self::assertCount($size + 1, $httpMethod->body()->data());
        self::assertEquals(123, $httpMethod->body()->data()['123']);
        unset($_REQUEST['lastKey']);
        self::assertCount($size, $httpMethod->body()->data());
    }

    private function httpMethodCustomClass(): HttpMethodInterface
    {
        $httpMethod = new class() implements HttpMethodInterface {
            use HttpMethodTrait;

            public function __construct()
            {
                $this->name = 'CUSTOM';
                $this->queryParams = new QueryParams();
                $this->messageBody = new RequestInBody(ContentType::TEXT_HTML);
            }

            public function data()
            {
                return $this->messageBody->$this->data();
            }
        };
        $_REQUEST = $this->arrayQueryParams();
        return new $httpMethod();
    }

}