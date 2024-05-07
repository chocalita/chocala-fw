<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Http\Request\Parts\Fakes\FakeQueryParams;
use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class CustomRequestDataTest extends TestCase
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
    protected function arrayToQueryString(array $input): string
    {
        return implode(
            '&',
            array_map(
                function ($v, $k) {
                    if (is_array($v)) {
                        return $k . '[]=' . implode('&' . $k . '[]=', $v);
                    } else {
                        return $k . '=' . $v;
                    }
                },
                $input,
                array_keys($input)
            )
        );
    }

    public function testName()
    {
        $httpMethod = $this->requestDataCustomClass();
        self::assertIsObject($httpMethod);
//        self::assertEquals('CUSTOM', $httpMethod->name());
    }

    public function testQueryParams()
    {
        $httpMethod = $this->requestDataCustomClass();
        $_GET = $this->arrayQueryParams();
        $size = sizeof($_GET);
        self::assertNotNull($httpMethod->queryParams());
        self::assertIsObject($httpMethod->queryParams());
        self::assertInstanceOf(QueryParamsInterface::class, $httpMethod->queryParams());
        self::assertCount($size, $httpMethod->queryParams()->data());
        unset($_GET['lastKey']);
        self::assertCount($size - 1, $httpMethod->queryParams()->data());
    }

    public function testBody()
    {
        $httpMethod = $this->requestDataCustomClass();
        //print_r($httpMethod);
        print_r('Printed object in -> ' . __CLASS__ . "\n");
        print_r($httpMethod->body());
        self::assertNotNull($httpMethod->body());
        self::assertIsObject($httpMethod->body());
        self::assertInstanceOf(MessageBodyInterface::class, $httpMethod->body());
        self::assertInstanceOf(RequestInBody::class, $httpMethod->body());
    }
    public function testData()
    {
        // Using $_REQUEST as the data source
        $httpMethod = $this->requestDataCustomClass();
        $size = sizeof($this->arrayQueryParams());
        self::assertNotEmpty($httpMethod->body()->data());
        self::assertCount($size, $httpMethod->body()->data());
        $_REQUEST['123'] = 123;
        self::assertCount($size + 1, $httpMethod->body()->data());
        self::assertEquals(123, $httpMethod->body()->data()['123']);
        unset($_REQUEST['lastKey']);
        self::assertCount($size, $httpMethod->body()->data());
    }

    private function requestDataCustomClass(): RequestDataInterface
    {
        $httpMethod = new class () implements RequestDataInterface {
            use RequestDataTrait;

            public function __construct()
            {
                $this->queryParams = new QueryParams();
                $this->messageBody = new RequestInBody(ContentType::TEXT_HTML);
            }

            public function data()
            {
                return $this->messageBody->data();
            }
        };
        $_REQUEST = $this->arrayQueryParams();
        return new $httpMethod();
    }
}
