<?php

namespace Chocala\Http\Method;

use Chocala\Base\IllegalArgumentException;
use Chocala\Http\HttpMethod;
use Chocala\Http\Parts\Fakes\FakeFormUrlencodedBody;
use Chocala\Http\Parts\Fakes\FakeJsonMessageBody;
use Chocala\Http\Parts\Fakes\FakeMessageBody;
use Chocala\Http\Parts\Fakes\FakePostFormDataBody;
use Chocala\Http\Parts\Fakes\FakeQueryParams;
use Chocala\Http\Parts\Fakes\FakeRawFormDataBody;
use Chocala\Http\Parts\Fakes\FakeTextHtmlBody;
use Chocala\Http\Parts\FormUrlencodedBody;
use Chocala\Http\Parts\JsonMessageBody;
use Chocala\Http\Parts\MessageBody;
use Chocala\Http\Parts\MessageBodyInterface;
use Chocala\Http\Parts\QueryParamsInterface;
use Chocala\Http\Parts\RawFormDataBody;
use Chocala\Http\Parts\TextHtmlBody;
use Chocala\Http\Request\CustomRequestDataTest;
use InvalidArgumentException;

//require_once 'CustomRequestContentTest.php';

class PutTest //extends CustomRequestContentTest
{

    private function newObject(): Put
    {
        return $this->newObjectFakeBody();
    }

    private function newObjectFakeBody(): Put
    {
        $this->initQueryParams();
        return new Put(new FakeMessageBody());
    }

    private function newObjectCustomMessageBody($bodyContent): Put
    {
        $this->initQueryParams();
        return new Put(new FakeMessageBody($bodyContent));
    }

    private function newObjectTextMessageBody(): Put
    {
        return $this->newObjectCustomMessageBody($this->textContent());
    }

    private function newObjectTextHtmlBody(): Put
    {
        $this->initQueryParams();
        return new Put(new FakeTextHtmlBody());
    }

    private function newObjectFormData(): Put
    {
        $this->initQueryParams();
        return new Put(new FakeRawFormDataBody());
    }

    private function newObjectFormUrlEncoded(): Put
    {
        $this->initQueryParams();
        return new Put(new FakeFormUrlencodedBody());
    }

    private function newObjectJsonMessageBody(): Put
    {
        $this->initQueryParams();
        return new Put(new FakeJsonMessageBody());
    }

    public function test__construct()
    {
        $put = new Put(new FakeMessageBody());
        self::assertIsObject($put);

        $put = new Put(new FakeQueryParams(), new FakeMessageBody());
        self::assertIsObject($put);

        $this->expectException(IllegalArgumentException::class);
        $this->expectExceptionMessageRegExp('/does not support \$_POST body/');
        new Put(new FakePostFormDataBody());
    }

    public function testName()
    {
        $put = $this->newObject();
        self::assertIsObject($put);
        self::assertEquals(HttpMethod::PUT, $put->name());
    }

    public function testQueryParams()
    {
        $put = $this->newObject();
        $size = sizeof($this->arrayQueryParams());
        self::assertNotNull($put->queryParams());
        self::assertIsObject($put->queryParams());
        self::assertInstanceOf(QueryParamsInterface::class, $put->queryParams());
        self::assertCount($size, $put->queryParams()->data());
        unset($_GET['lastKey']);
        self::assertCount($size-1, $put->queryParams()->data());
    }


    public function testBody()
    {
        $put = $this->newObject();
        self::assertNotNull($put->body());
        self::assertIsObject($put->body());

        $put = $this->newObjectFakeBody();
        self::assertNotNull($put->body());
        self::assertIsObject($put->body());
        self::assertInstanceOf(MessageBodyInterface::class, $put->body());
        self::assertInstanceOf(MessageBody::class, $put->body());

        $put = $this->newObjectTextMessageBody();
        self::assertNotNull($put->body());
        self::assertIsObject($put->body());
        self::assertInstanceOf(MessageBodyInterface::class, $put->body());
        self::assertInstanceOf(MessageBody::class, $put->body());

        $put = $this->newObjectTextHtmlBody();
        self::assertNotNull($put->body());
        self::assertIsObject($put->body());
        self::assertInstanceOf(MessageBodyInterface::class, $put->body());
        self::assertInstanceOf(TextHtmlBody::class, $put->body());

        $put = $this->newObjectFormData();
        self::assertNotNull($put->body());
        self::assertIsObject($put->body());
        self::assertInstanceOf(MessageBodyInterface::class, $put->body());
        self::assertInstanceOf(RawFormDataBody::class, $put->body());

        $put = $this->newObjectFormUrlEncoded();
        self::assertNotNull($put->body());
        self::assertIsObject($put->body());
        self::assertInstanceOf(MessageBodyInterface::class, $put->body());
        self::assertInstanceOf(FormUrlencodedBody::class, $put->body());

        $put = $this->newObjectJsonMessageBody();
        self::assertNotNull($put->body());
        self::assertIsObject($put->body());
        self::assertInstanceOf(MessageBodyInterface::class, $put->body());
        self::assertInstanceOf(JsonMessageBody::class, $put->body());

        $put = $this->newObjectCustomMessageBody(new \ArrayIterator([1,10]));
        self::assertNotNull($put->body());
        self::assertIsObject($put->body());
        self::assertInstanceOf(MessageBodyInterface::class, $put->body());
        self::assertInstanceOf(MessageBody::class, $put->body());
    }

    public function testData()
    {
        // Using FakeMessageBody as messageBody
        $put = $this->newObjectFakeBody();
        self::assertNotNull($put->data());
        self::assertIsString($put->data());
        self::assertEmpty($put->data());

        // Using MessageBody as messageBody
        $put = $this->newObjectTextMessageBody();
        self::assertNotNull($put->data());
        self::assertNotEmpty($put->data());
        self::assertIsString($put->data());
        self::assertContains('Text plain', $put->data());

        // Using TextHtmlBody as messageBody
        $put = $this->newObjectTextHtmlBody();
        self::assertNotNull($put->data());
        self::assertNotEmpty($put->data());
        self::assertIsString($put->data());
        self::assertContains('<h1>Title</h1>', $put->data());

        // Using FormDataBody as messageBody (only allowed $_POST source)
        $put = $this->newObjectFormData();
        self::assertNotNull($put->data());
        self::assertNotEmpty($put->data());
        self::assertIsArray($put->data());
        self::assertCount(FakeRawFormDataBody::DATA_COUNT, $put->data());

        // Using FormUrlEncodedData as messageBody
        $put = $this->newObjectFormUrlEncoded();
        $size = sizeof(FakeFormUrlencodedBody::ARRAY_DATA);
        self::assertNotNull($put->data());
        self::assertNotEmpty($put->data());
        self::assertIsArray($put->data());
        self::assertCount($size, $put->data());

        // Using JsonMessageBody as messageBody
        $put = $this->newObjectJsonMessageBody();
        self::assertNotNull($put->data());
        self::assertNotEmpty($put->data());
        self::assertIsObject($put->data());
        self::assertInstanceOf(\stdClass::class, $put->data());
        self::assertObjectHasAttribute('key', $put->data());

        // Using a custom MessageBody as messageBody
        $arrayBase = [1, 2, 3];
        $put = $this->newObjectCustomMessageBody(new \ArrayIterator($arrayBase));
        self::assertNotNull($put->data());
        self::assertNotEmpty($put->data());
        self::assertIsNotArray($put->data());
        self::assertIsObject($put->data());
        self::assertInstanceOf(\ArrayIterator::class, $put->data());
        self::assertSameSize($arrayBase, $put->data());
        self::assertEquals(1, $put->data()->offsetGet(0));
        self::assertEquals(2, $put->data()->offsetGet(1));
        self::assertEquals(3, $put->data()->offsetGet(2));
    }

    public function testConstructWithoutArgs()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/Invalid number of arguments/');
        new Put();
    }

}