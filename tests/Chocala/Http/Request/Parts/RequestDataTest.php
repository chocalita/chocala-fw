<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Http\Request\Parts\Fakes\FakeFormDataBody;
use Chocala\Http\Request\Parts\Fakes\FakeFormUrlencodedBody;
use Chocala\Http\Request\Parts\Fakes\FakeJsonMessageBody;
use Chocala\Http\Request\Parts\Fakes\FakeMessageBody;
use Chocala\Http\Request\Parts\Fakes\FakePostFormDataBody;
use Chocala\Http\Request\Parts\Fakes\FakeQueryParams;
use Chocala\Http\Request\Parts\Fakes\FakeRawFormDataBody;
use Chocala\Http\Request\Parts\Fakes\FakeRequestData;
use Chocala\Http\Request\Parts\Fakes\FakeTextHtmlBody;
use InvalidArgumentException;

require_once 'CustomRequestDataTest.php';

class RequestDataTest extends CustomRequestDataTest
{
    private FakeRequestData $fakeRequestData;

    public function setUp()
    {
        $this->fakeRequestData = new FakeRequestData();
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

    private function newObjectBoundariesFormData(): RequestData
    {
        $this->initQueryParams();
        return new RequestData(new FakeRawFormDataBody());
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
        $requestData = new RequestData(new FakeMessageBody());
        self::assertIsObject($requestData);

        $requestData = new RequestData(new FakeQueryParams(), new FakeMessageBody());
        self::assertIsObject($requestData);
    }

    public function testQueryParams()
    {
        self::assertNotNull($this->fakeRequestData->queryParams());
        self::assertIsObject($this->fakeRequestData->queryParams());
        self::assertInstanceOf(QueryParamsInterface::class, $this->fakeRequestData->queryParams());
        self::assertNotEmpty($this->fakeRequestData->queryParams()->data());
    }

    public function testBody()
    {
        self::assertNotNull($this->fakeRequestData->body());
        self::assertIsObject($this->fakeRequestData->body());
        self::assertInstanceOf(MessageBodyInterface::class, $this->fakeRequestData->body());
        self::assertInstanceOf(MessageBody::class, $this->fakeRequestData->body());

        $requestData = $this->newObjectTextMessageBody();
        self::assertNotNull($requestData->body());
        self::assertIsObject($requestData->body());
        self::assertInstanceOf(MessageBodyInterface::class, $requestData->body());
        self::assertInstanceOf(MessageBody::class, $requestData->body());

        $requestData = $this->newObjectTextHtmlBody();
        self::assertNotNull($requestData->body());
        self::assertIsObject($requestData->body());
        self::assertInstanceOf(MessageBodyInterface::class, $requestData->body());
        self::assertInstanceOf(TextHtmlBody::class, $requestData->body());

        $requestData = $this->newObjectPostFormData();
        self::assertNotNull($requestData->body());
        self::assertIsObject($requestData->body());
        self::assertInstanceOf(MessageBodyInterface::class, $requestData->body());
        self::assertInstanceOf(PostFormDataBody::class, $requestData->body());

        $requestData = $this->newObjectBoundariesFormData();
        self::assertNotNull($requestData->body());
        self::assertIsObject($requestData->body());
        self::assertInstanceOf(MessageBodyInterface::class, $requestData->body());
        self::assertInstanceOf(RawFormDataBody::class, $requestData->body());

        $requestData = $this->newObjectFormUrlEncoded();
        self::assertNotNull($requestData->body());
        self::assertIsObject($requestData->body());
        self::assertInstanceOf(MessageBodyInterface::class, $requestData->body());
        self::assertInstanceOf(FormUrlencodedBody::class, $requestData->body());

        $requestData = $this->newObjectJsonMessageBody();
        self::assertNotNull($requestData->body());
        self::assertIsObject($requestData->body());
        self::assertInstanceOf(MessageBodyInterface::class, $requestData->body());
        self::assertInstanceOf(JsonMessageBody::class, $requestData->body());

        $requestData = $this->newObjectCustomMessageBody(new \ArrayIterator([1,10]));
        self::assertNotNull($requestData->body());
        self::assertIsObject($requestData->body());
        self::assertInstanceOf(MessageBodyInterface::class, $requestData->body());
        self::assertInstanceOf(MessageBody::class, $requestData->body());
    }

    public function testData()
    {
        // Using FakeMessageBody as messageBody
        self::assertNotNull($this->fakeRequestData->data());
        self::assertIsString($this->fakeRequestData->data());
        self::assertEmpty($this->fakeRequestData->data());

        // Using MessageBody as messageBody
        $requestData = $this->newObjectTextMessageBody();
        self::assertNotNull($requestData->data());
        self::assertNotEmpty($requestData->data());
        self::assertIsString($requestData->data());
        self::assertContains('Text plain', $requestData->data());

        // Using TextHtmlContent as messageBody
        $requestData = $this->newObjectTextHtmlBody();
        self::assertNotNull($requestData->data());
        self::assertNotEmpty($requestData->data());
        self::assertIsString($requestData->data());
        self::assertContains('<h1>Title</h1>', $requestData->data());

        // Using FormDataContent as messageBody (only allowed $_POST source)
        $requestData = $this->newObjectPostFormData();
        $size = sizeof(FakeFormDataBody::ARRAY_DATA);
        self::assertNotNull($requestData->data());
        self::assertNotEmpty($requestData->data());
        self::assertIsArray($requestData->data());
        self::assertCount($size, $requestData->data());

        // Using FormDataBody as messageBody (only allowed boundaries  source)
        $requestData = $this->newObjectBoundariesFormData();
        self::assertNotNull($requestData->data());
        self::assertNotEmpty($requestData->data());
        self::assertIsArray($requestData->data());
        self::assertCount(FakeRawFormDataBody::DATA_COUNT, $requestData->data());

        // Using FormUrlEncodedData as messageBody
        $requestData = $this->newObjectFormUrlEncoded();
        $size = sizeof(FakeFormUrlencodedBody::ARRAY_DATA);
        self::assertNotNull($requestData->data());
        self::assertNotEmpty($requestData->data());
        self::assertIsArray($requestData->data());
        self::assertCount($size, $requestData->data());

        // Using JsonMessageBody as messageBody
        $requestData = $this->newObjectJsonMessageBody();
        self::assertNotNull($requestData->data());
        self::assertNotEmpty($requestData->data());
        self::assertIsObject($requestData->data());
        self::assertInstanceOf(\stdClass::class, $requestData->data());
        self::assertObjectHasAttribute('key', $requestData->data());

        // Using a custom MessageBody as messageBody
        $arrayBase = [1, 2, 3];
        $requestData = $this->newObjectCustomMessageBody(new \ArrayIterator($arrayBase));
        self::assertNotNull($requestData->data());
        self::assertNotEmpty($requestData->data());
        self::assertIsNotArray($requestData->data());
        self::assertIsObject($requestData->data());
        self::assertInstanceOf(\ArrayIterator::class, $requestData->data());
        self::assertSameSize($arrayBase, $requestData->data());
        self::assertEquals(1, $requestData->data()->offsetGet(0));
        self::assertEquals(2, $requestData->data()->offsetGet(1));
        self::assertEquals(3, $requestData->data()->offsetGet(2));
    }

    public function testConstructWithoutArgs()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/Invalid number of arguments/');
        new RequestData();
    }
}
