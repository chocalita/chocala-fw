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
use Chocala\Http\Parts\Fakes\FakeBoundariedFormDataBody;
use Chocala\Http\Parts\Fakes\FakeRequestData;
use Chocala\Http\Parts\Fakes\FakeTextHtmlBody;
use InvalidArgumentException;

require_once 'CustomRequestContentTest.php';

class RequestContentTest extends CustomRequestContentTest
{

    private FakeRequestData $defaultRequestContent;

    public function setUp()
    {
        $this->defaultRequestContent = new FakeRequestData();
    }

    private function newObjectCustomMessageBody($bodyContent): RequestData
    {
        $this->initQueryParams();
        return new RequestData(new FakeMessageBody($bodyContent));
    }

    private function newObjectTextMessageBody(): RequestData
    {
        return $this->newObjectCustomMessageBody($this->textContent());
    }

    private function newObjectTextHtmlBody(): RequestData
    {
        $this->initQueryParams();
        return new RequestData(new FakeTextHtmlBody());
    }

    private function newObjectPostFormData(): RequestData
    {
        $this->initQueryParams();
        return new RequestData(new FakePostFormDataBody());
    }

    private function newObjectRawFormData(): Put
    {
        $this->initQueryParams();
        return new Put(new FakeBoundariedFormDataBody());
    }

    private function newObjectFormUrlEncoded(): RequestData
    {
        $this->initQueryParams();
        return new RequestData(new FakeFormUrlencodedBody());
    }

    private function newObjectJsonMessageBody(): RequestData
    {
        $this->initQueryParams();
        return new RequestData(new FakeJsonMessageBody());
    }

    public function test__construct()
    {
        $requestContent = new RequestData(new FakeMessageBody());
        self::assertIsObject($requestContent);

        $requestContent = new RequestData(new FakeQueryParams(), new FakeMessageBody());
        self::assertIsObject($requestContent);

        $this->expectException(IllegalArgumentException::class);
        $this->expectExceptionMessageRegExp('/does not support raw-data body/');
        new RequestData(new FakeBoundariedFormDataBody());
    }

    public function testQueryParams()
    {
        self::assertNotNull($this->defaultRequestContent->queryParams());
        self::assertIsObject($this->defaultRequestContent->queryParams());
        self::assertInstanceOf(QueryParamsInterface::class, $this->defaultRequestContent->queryParams());
        self::assertNotEmpty($this->defaultRequestContent->queryParams()->data());
    }

    public function testBody()
    {
        self::assertNotNull($this->defaultRequestContent->body());
        self::assertIsObject($this->defaultRequestContent->body());
        self::assertInstanceOf(MessageBodyInterface::class, $this->defaultRequestContent->body());
        self::assertInstanceOf(MessageBody::class, $this->defaultRequestContent->body());

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
        self::assertInstanceOf(BoundariedFormDataBody::class, $requestContent->body());

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
        self::assertNotNull($this->defaultRequestContent->data());
        self::assertIsString($this->defaultRequestContent->data());
        self::assertEmpty($this->defaultRequestContent->data());

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
        self::assertCount(FakeBoundariedFormDataBody::DATA_COUNT, $requestContent->data());

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
        new RequestData();
    }

}