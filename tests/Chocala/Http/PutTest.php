<?php

namespace Chocala\Http;

use Chocala\Base\IllegalArgumentException;
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
use InvalidArgumentException;

require_once 'HttpMethodTest.php';

class PutTest extends HttpMethodTest
{

    private function newObject(): Put
    {
        return $this->newObjectFakeContent();
    }

    private function newObjectFakeContent(): Put
    {
        $this->initQueryParams();
        return new Put(new FakeMessageBody());
    }

    private function newObjectCustomMessageContent($bodyContent): Put
    {
        $this->initQueryParams();
        return new Put(new FakeMessageBody($bodyContent));
    }

    private function newObjectTextMessageContent(): Put
    {
        return $this->newObjectCustomMessageContent($this->textContent());
    }

    private function newObjectTextHtmlContent(): Put
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

    private function newObjectJsonMessageContent(): Put
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

    public function testId()
    {
        $put = $this->newObject();
        self::assertNotNull($put->id());
        self::assertGreaterThan(8, strlen($put->id()));
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


    public function testContent()
    {
        $put = $this->newObject();
        self::assertNotNull($put->content());
        self::assertIsObject($put->content());

        $put = $this->newObjectFakeContent();
        self::assertInstanceOf(MessageBodyInterface::class, $put->content());
        self::assertInstanceOf(MessageBody::class, $put->content());

        $put = $this->newObjectTextMessageContent();
        self::assertInstanceOf(MessageBodyInterface::class, $put->content());
        self::assertInstanceOf(MessageBody::class, $put->content());

        $put = $this->newObjectTextHtmlContent();
        self::assertInstanceOf(MessageBodyInterface::class, $put->content());
        self::assertInstanceOf(TextHtmlBody::class, $put->content());

        $put = $this->newObjectFormData();
        self::assertInstanceOf(MessageBodyInterface::class, $put->content());
        self::assertInstanceOf(RawFormDataBody::class, $put->content());

        $put = $this->newObjectFormUrlEncoded();
        self::assertInstanceOf(MessageBodyInterface::class, $put->content());
        self::assertInstanceOf(FormUrlencodedBody::class, $put->content());

        $put = $this->newObjectJsonMessageContent();
        self::assertInstanceOf(MessageBodyInterface::class, $put->content());
        self::assertInstanceOf(JsonMessageBody::class, $put->content());

        $put = $this->newObjectCustomMessageContent(new \ArrayIterator([1,10]));
        self::assertInstanceOf(MessageBodyInterface::class, $put->content());
        self::assertInstanceOf(MessageBody::class, $put->content());
    }

    public function testData()
    {
        // Using FakeMessageContent as messageContent
        $put = $this->newObjectFakeContent();
        self::assertNotNull($put->data());
        self::assertIsString($put->data());
        self::assertEmpty($put->data());

        // Using MessageContent as messageContent
        $put = $this->newObjectTextMessageContent();
        self::assertNotNull($put->data());
        self::assertNotEmpty($put->data());
        self::assertIsString($put->data());
        self::assertContains('Text plain', $put->data());

        // Using TextHtmlContent as messageContent
        $put = $this->newObjectTextHtmlContent();
        self::assertNotNull($put->data());
        self::assertNotEmpty($put->data());
        self::assertIsString($put->data());
        self::assertContains('<h1>Title</h1>', $put->data());

        // Using FormDataContent as messageContent (only allowed $_POST source)
        $put = $this->newObjectFormData();
        self::assertNotNull($put->data());
        self::assertNotEmpty($put->data());
        self::assertIsArray($put->data());
        self::assertCount(FakeRawFormDataBody::DATA_COUNT, $put->data());

        // Using FormUrlEncodedData as messageContent
        $put = $this->newObjectFormUrlEncoded();
        $size = sizeof(FakeFormUrlencodedBody::ARRAY_DATA);
        self::assertNotNull($put->data());
        self::assertNotEmpty($put->data());
        self::assertIsArray($put->data());
        self::assertCount($size, $put->data());

        // Using JsonMessageContent as messageContent
        $put = $this->newObjectJsonMessageContent();
        self::assertNotNull($put->data());
        self::assertNotEmpty($put->data());
        self::assertIsObject($put->data());
        self::assertInstanceOf(\stdClass::class, $put->data());
        self::assertObjectHasAttribute('key', $put->data());

        // Using a custom MessageContent as messageContent
        $arrayBase = [1, 2, 3];
        $put = $this->newObjectCustomMessageContent(new \ArrayIterator($arrayBase));
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