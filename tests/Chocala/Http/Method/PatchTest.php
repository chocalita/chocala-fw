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
use InvalidArgumentException;

require_once 'HttpMethodTest.php';

class PatchTest extends HttpMethodTest
{

    private function newObject(): Patch
    {
        return $this->newObjectFakeBody();
    }

    private function newObjectFakeBody(): Patch
    {
        $this->initQueryParams();
        return new Patch(new FakeMessageBody());
    }

    private function newObjectCustomMessageBody($bodyContent): Patch
    {
        $this->initQueryParams();
        return new Patch(new FakeMessageBody($bodyContent));
    }

    private function newObjectTextMessageBody(): Patch
    {
        return $this->newObjectCustomMessageBody($this->textContent());
    }

    private function newObjectTextHtmlBody(): Patch
    {
        $this->initQueryParams();
        return new Patch(new FakeTextHtmlBody());
    }

    private function newObjectFormData(): Patch
    {
        $this->initQueryParams();
        return new Patch(new FakeRawFormDataBody());
    }

    private function newObjectFormUrlEncoded(): Patch
    {
        $this->initQueryParams();
        return new Patch(new FakeFormUrlencodedBody());
    }

    private function newObjectJsonMessageBody(): Patch
    {
        $this->initQueryParams();
        return new Patch(new FakeJsonMessageBody());
    }

    public function test__construct()
    {
        $patch = new Patch(new FakeMessageBody());
        self::assertIsObject($patch);

        $patch = new Patch(new FakeQueryParams(), new FakeMessageBody());
        self::assertIsObject($patch);

        $this->expectException(IllegalArgumentException::class);
        $this->expectExceptionMessageRegExp('/does not support \$_POST body/');
        new Patch(new FakePostFormDataBody());
    }

    public function testName()
    {
        $patch = $this->newObject();
        self::assertIsObject($patch);
        self::assertEquals(HttpMethod::PATCH, $patch->name());
    }

    public function testQueryParams()
    {
        $patch = $this->newObject();
        $size = sizeof($this->arrayQueryParams());
        self::assertNotNull($patch->queryParams());
        self::assertIsObject($patch->queryParams());
        self::assertInstanceOf(QueryParamsInterface::class, $patch->queryParams());
        self::assertCount($size, $patch->queryParams()->data());
        unset($_GET['lastKey']);
        self::assertCount($size-1, $patch->queryParams()->data());
    }


    public function testBody()
    {
        $patch = $this->newObject();
        self::assertNotNull($patch->body());
        self::assertIsObject($patch->body());

        $patch = $this->newObjectFakeBody();
        self::assertNotNull($patch->body());
        self::assertIsObject($patch->body());
        self::assertInstanceOf(MessageBodyInterface::class, $patch->body());
        self::assertInstanceOf(MessageBody::class, $patch->body());

        $patch = $this->newObjectTextMessageBody();
        self::assertNotNull($patch->body());
        self::assertIsObject($patch->body());
        self::assertInstanceOf(MessageBodyInterface::class, $patch->body());
        self::assertInstanceOf(MessageBody::class, $patch->body());

        $patch = $this->newObjectTextHtmlBody();
        self::assertNotNull($patch->body());
        self::assertIsObject($patch->body());
        self::assertInstanceOf(MessageBodyInterface::class, $patch->body());
        self::assertInstanceOf(TextHtmlBody::class, $patch->body());

        $patch = $this->newObjectFormData();
        self::assertNotNull($patch->body());
        self::assertIsObject($patch->body());
        self::assertInstanceOf(MessageBodyInterface::class, $patch->body());
        self::assertInstanceOf(RawFormDataBody::class, $patch->body());

        $patch = $this->newObjectFormUrlEncoded();
        self::assertNotNull($patch->body());
        self::assertIsObject($patch->body());
        self::assertInstanceOf(MessageBodyInterface::class, $patch->body());
        self::assertInstanceOf(FormUrlencodedBody::class, $patch->body());

        $patch = $this->newObjectJsonMessageBody();
        self::assertNotNull($patch->body());
        self::assertIsObject($patch->body());
        self::assertInstanceOf(MessageBodyInterface::class, $patch->body());
        self::assertInstanceOf(JsonMessageBody::class, $patch->body());

        $patch = $this->newObjectCustomMessageBody(new \ArrayIterator([1,10]));
        self::assertNotNull($patch->body());
        self::assertIsObject($patch->body());
        self::assertInstanceOf(MessageBodyInterface::class, $patch->body());
        self::assertInstanceOf(MessageBody::class, $patch->body());
    }

    public function testData()
    {
        // Using FakeMessageBody as messageBody
        $patch = $this->newObjectFakeBody();
        self::assertNotNull($patch->data());
        self::assertIsString($patch->data());
        self::assertEmpty($patch->data());

        // Using MessageBody as messageBody
        $patch = $this->newObjectTextMessageBody();
        self::assertNotNull($patch->data());
        self::assertNotEmpty($patch->data());
        self::assertIsString($patch->data());
        self::assertContains('Text plain', $patch->data());

        // Using TextHtmlBody as messageBody
        $patch = $this->newObjectTextHtmlBody();
        self::assertNotNull($patch->data());
        self::assertNotEmpty($patch->data());
        self::assertIsString($patch->data());
        self::assertContains('<h1>Title</h1>', $patch->data());

        // Using FormDataBody as messageBody (only allowed $_POST source)
        $patch = $this->newObjectFormData();
        self::assertNotNull($patch->data());
        self::assertNotEmpty($patch->data());
        self::assertIsArray($patch->data());
        self::assertCount(FakeRawFormDataBody::DATA_COUNT, $patch->data());

        // Using FormUrlEncodedData as messageBody
        $patch = $this->newObjectFormUrlEncoded();
        $size = sizeof(FakeFormUrlencodedBody::ARRAY_DATA);
        self::assertNotNull($patch->data());
        self::assertNotEmpty($patch->data());
        self::assertIsArray($patch->data());
        self::assertCount($size, $patch->data());

        // Using JsonMessageBody as messageBody
        $patch = $this->newObjectJsonMessageBody();
        self::assertNotNull($patch->data());
        self::assertNotEmpty($patch->data());
        self::assertIsObject($patch->data());
        self::assertInstanceOf(\stdClass::class, $patch->data());
        self::assertObjectHasAttribute('key', $patch->data());

        // Using a custom MessageBody as messageBody
        $arrayBase = [1, 2, 3];
        $patch = $this->newObjectCustomMessageBody(new \ArrayIterator($arrayBase));
        self::assertNotNull($patch->data());
        self::assertNotEmpty($patch->data());
        self::assertIsNotArray($patch->data());
        self::assertIsObject($patch->data());
        self::assertInstanceOf(\ArrayIterator::class, $patch->data());
        self::assertSameSize($arrayBase, $patch->data());
        self::assertEquals(1, $patch->data()->offsetGet(0));
        self::assertEquals(2, $patch->data()->offsetGet(1));
        self::assertEquals(3, $patch->data()->offsetGet(2));
    }

    public function testConstructWithoutArgs()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/Invalid number of arguments/');
        new Patch();
    }

}