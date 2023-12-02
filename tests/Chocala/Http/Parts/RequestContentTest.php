<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\Http\Method\Put;
use Chocala\Http\Parts\Fakes\FakeFormDataBody;
use Chocala\Http\Parts\Fakes\FakeFormUrlencodedBody;
use Chocala\Http\Parts\Fakes\FakeJsonMessageBody;
use Chocala\Http\Parts\Fakes\FakeMessageBody;
use Chocala\Http\Parts\Fakes\FakePostFormDataBody;
use Chocala\Http\Parts\Fakes\FakeQueryParams;
use Chocala\Http\Parts\Fakes\FakeRawFormDataBody;
use Chocala\Http\Parts\Fakes\FakeTextHtmlBody;
use InvalidArgumentException;

require_once 'CustomRequestContentTest.php';

class RequestContentTest extends CustomRequestContentTest
{

    private function newObject(): RequestContent
    {
        return $this->newObjectFakeBody();
    }

    private function newObjectFakeBody(): RequestContent
    {
        $this->initQueryParams();
        return new RequestContent(new FakeMessageBody());
    }

    private function newObjectCustomMessageBody($bodyContent): RequestContent
    {
        $this->initQueryParams();
        return new RequestContent(new FakeMessageBody($bodyContent));
    }

    private function newObjectTextMessageBody(): RequestContent
    {
        return $this->newObjectCustomMessageBody($this->textContent());
    }

    private function newObjectTextHtmlBody(): RequestContent
    {
        $this->initQueryParams();
        return new RequestContent(new FakeTextHtmlBody());
    }

    private function newObjectPostFormData(): RequestContent
    {
        $this->initQueryParams();
        return new RequestContent(new FakePostFormDataBody());
    }

    private function newObjectRawFormData(): Put
    {
        $this->initQueryParams();
        return new Put(new FakeRawFormDataBody());
    }

    private function newObjectFormUrlEncoded(): RequestContent
    {
        $this->initQueryParams();
        return new RequestContent(new FakeFormUrlencodedBody());
    }

    private function newObjectJsonMessageBody(): RequestContent
    {
        $this->initQueryParams();
        return new RequestContent(new FakeJsonMessageBody());
    }

    public function test__construct()
    {
        $requestContent = new RequestContent(new FakeMessageBody());
        self::assertIsObject($requestContent);

        $requestContent = new RequestContent(new FakeQueryParams(), new FakeMessageBody());
        self::assertIsObject($requestContent);

        $this->expectException(IllegalArgumentException::class);
        $this->expectExceptionMessageRegExp('/does not support raw-data body/');
        new RequestContent(new FakeRawFormDataBody());
    }

    public function testQueryParams()
    {
        $requestContent = $this->newObject();
        $size = sizeof($this->arrayQueryParams());
        self::assertNotNull($requestContent->queryParams());
        self::assertIsObject($requestContent->queryParams());
        self::assertInstanceOf(QueryParamsInterface::class, $requestContent->queryParams());
        self::assertCount($size, $requestContent->queryParams()->data());
        unset($_GET['lastKey']);
        self::assertCount($size-1, $requestContent->queryParams()->data());
    }

    public function testBody()
    {
        $requestContent = $this->newObject();
        self::assertNotNull($requestContent->body());
        self::assertIsObject($requestContent->body());

        $requestContent = $this->newObjectFakeBody();
        self::assertNotNull($requestContent->body());
        self::assertIsObject($requestContent->body());
        self::assertInstanceOf(MessageBodyInterface::class, $requestContent->body());
        self::assertInstanceOf(MessageBody::class, $requestContent->body());

        $requestContent = $this->newObjectTextMessageBody();
        self::assertNotNull($requestContent->body());
        self::assertIsObject($requestContent->body());
        self::assertInstanceOf(MessageBodyInterface::class, $requestContent->body());
        self::assertInstanceOf(MessageBody::class, $requestContent->body());

        $requestContent = $this->newObjectTextHtmlBody();
        self::assertNotNull($requestContent->body());
        self::assertIsObject($requestContent->body());
        self::assertInstanceOf(MessageBodyInterface::class, $requestContent->body());
        self::assertInstanceOf(TextHtmlBody::class, $requestContent->body());

        $requestContent = $this->newObjectPostFormData();
        self::assertNotNull($requestContent->body());
        self::assertIsObject($requestContent->body());
        self::assertInstanceOf(MessageBodyInterface::class, $requestContent->body());
        self::assertInstanceOf(PostFormDataBody::class, $requestContent->body());

        $requestContent = $this->newObjectRawFormData();
        self::assertNotNull($requestContent->body());
        self::assertIsObject($requestContent->body());
        self::assertInstanceOf(MessageBodyInterface::class, $requestContent->body());
        self::assertInstanceOf(RawFormDataBody::class, $requestContent->body());

        $requestContent = $this->newObjectFormUrlEncoded();
        self::assertNotNull($requestContent->body());
        self::assertIsObject($requestContent->body());
        self::assertInstanceOf(MessageBodyInterface::class, $requestContent->body());
        self::assertInstanceOf(FormUrlencodedBody::class, $requestContent->body());

        $requestContent = $this->newObjectJsonMessageBody();
        self::assertNotNull($requestContent->body());
        self::assertIsObject($requestContent->body());
        self::assertInstanceOf(MessageBodyInterface::class, $requestContent->body());
        self::assertInstanceOf(JsonMessageBody::class, $requestContent->body());

        $requestContent = $this->newObjectCustomMessageBody(new \ArrayIterator([1,10]));
        self::assertNotNull($requestContent->body());
        self::assertIsObject($requestContent->body());
        self::assertInstanceOf(MessageBodyInterface::class, $requestContent->body());
        self::assertInstanceOf(MessageBody::class, $requestContent->body());
    }

    public function testData()
    {
        // Using FakeMessageBody as messageBody
        $requestContent = $this->newObjectFakeBody();
        self::assertNotNull($requestContent->data());
        self::assertIsString($requestContent->data());
        self::assertEmpty($requestContent->data());

        // Using MessageBody as messageBody
        $requestContent = $this->newObjectTextMessageBody();
        self::assertNotNull($requestContent->data());
        self::assertNotEmpty($requestContent->data());
        self::assertIsString($requestContent->data());
        self::assertContains('Text plain', $requestContent->data());

        // Using TextHtmlContent as messageBody
        $requestContent = $this->newObjectTextHtmlBody();
        self::assertNotNull($requestContent->data());
        self::assertNotEmpty($requestContent->data());
        self::assertIsString($requestContent->data());
        self::assertContains('<h1>Title</h1>', $requestContent->data());

        // Using FormDataContent as messageBody (only allowed $_POST source)
        $requestContent = $this->newObjectPostFormData();
        $size = sizeof(FakeFormDataBody::ARRAY_DATA);
        self::assertNotNull($requestContent->data());
        self::assertNotEmpty($requestContent->data());
        self::assertIsArray($requestContent->data());
        self::assertCount($size, $requestContent->data());

        // Using FormDataBody as messageBody (only allowed $_POST source)
        $requestContent = $this->newObjectRawFormData();
        self::assertNotNull($requestContent->data());
        self::assertNotEmpty($requestContent->data());
        self::assertIsArray($requestContent->data());
        self::assertCount(FakeRawFormDataBody::DATA_COUNT, $requestContent->data());

        // Using FormUrlEncodedData as messageBody
        $requestContent = $this->newObjectFormUrlEncoded();
        $size = sizeof(FakeFormUrlencodedBody::ARRAY_DATA);
        self::assertNotNull($requestContent->data());
        self::assertNotEmpty($requestContent->data());
        self::assertIsArray($requestContent->data());
        self::assertCount($size, $requestContent->data());

        // Using JsonMessageBody as messageBody
        $requestContent = $this->newObjectJsonMessageBody();
        self::assertNotNull($requestContent->data());
        self::assertNotEmpty($requestContent->data());
        self::assertIsObject($requestContent->data());
        self::assertInstanceOf(\stdClass::class, $requestContent->data());
        self::assertObjectHasAttribute('key', $requestContent->data());

        // Using a custom MessageBody as messageBody
        $arrayBase = [1, 2, 3];
        $requestContent = $this->newObjectCustomMessageBody(new \ArrayIterator($arrayBase));
        self::assertNotNull($requestContent->data());
        self::assertNotEmpty($requestContent->data());
        self::assertIsNotArray($requestContent->data());
        self::assertIsObject($requestContent->data());
        self::assertInstanceOf(\ArrayIterator::class, $requestContent->data());
        self::assertSameSize($arrayBase, $requestContent->data());
        self::assertEquals(1, $requestContent->data()->offsetGet(0));
        self::assertEquals(2, $requestContent->data()->offsetGet(1));
        self::assertEquals(3, $requestContent->data()->offsetGet(2));
    }

    public function testConstructWithoutArgs()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/Invalid number of arguments/');
        new RequestContent();
    }

}