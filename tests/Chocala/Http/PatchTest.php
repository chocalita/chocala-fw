<?php

namespace Chocala\Http;

use Chocala\Base\IllegalArgumentException;
use Chocala\Http\Parts\Fakes\FakeFormUrlencodedData;
use Chocala\Http\Parts\Fakes\FakeJsonMessageContent;
use Chocala\Http\Parts\Fakes\FakeMessageContent;
use Chocala\Http\Parts\Fakes\FakePostFormDataContent;
use Chocala\Http\Parts\Fakes\FakeQueryParams;
use Chocala\Http\Parts\Fakes\FakeRawFormDataContent;
use Chocala\Http\Parts\Fakes\FakeTextHtmlContent;
use Chocala\Http\Parts\FormUrlencodedData;
use Chocala\Http\Parts\JsonMessageContent;
use Chocala\Http\Parts\MessageContent;
use Chocala\Http\Parts\MessageContentInterface;
use Chocala\Http\Parts\QueryParamsInterface;
use Chocala\Http\Parts\RawFormDataContent;
use Chocala\Http\Parts\TextHtmlContent;
use InvalidArgumentException;

require_once 'HttpMethodTest.php';

class PatchTest extends HttpMethodTest
{

    private function newObject(): Patch
    {
        return $this->newObjectFakeContent();
    }

    private function newObjectFakeContent(): Patch
    {
        $this->initQueryParams();
        return new Patch(new FakeMessageContent());
    }

    private function newObjectCustomMessageContent($bodyContent): Patch
    {
        $this->initQueryParams();
        return new Patch(new FakeMessageContent($bodyContent));
    }

    private function newObjectTextMessageContent(): Patch
    {
        return $this->newObjectCustomMessageContent($this->textContent());
    }

    private function newObjectTextHtmlContent(): Patch
    {
        $this->initQueryParams();
        return new Patch(new FakeTextHtmlContent());
    }

    private function newObjectFormData(): Patch
    {
        $this->initQueryParams();
        return new Patch(new FakeRawFormDataContent());
    }

    private function newObjectFormUrlEncoded(): Patch
    {
        $this->initQueryParams();
        return new Patch(new FakeFormUrlencodedData());
    }

    private function newObjectJsonMessageContent(): Patch
    {
        $this->initQueryParams();
        return new Patch(new FakeJsonMessageContent());
    }

    public function test__construct()
    {
        $patch = new Patch(new FakeMessageContent());
        self::assertIsObject($patch);

        $patch = new Patch(new FakeQueryParams(), new FakeMessageContent());
        self::assertIsObject($patch);

        $this->expectException(IllegalArgumentException::class);
        $this->expectExceptionMessageRegExp('/does not support \$_POST body/');
        new Patch(new FakePostFormDataContent());
    }

    public function testName()
    {
        $patch = $this->newObject();
        self::assertIsObject($patch);
        self::assertEquals(HttpMethod::PATCH, $patch->name());
    }

    public function testId()
    {
        $patch = $this->newObject();
        self::assertNotNull($patch->id());
        self::assertGreaterThan(8, strlen($patch->id()));
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


    public function testContent()
    {
        $patch = $this->newObject();
        self::assertNotNull($patch->content());
        self::assertIsObject($patch->content());

        $patch = $this->newObjectFakeContent();
        self::assertInstanceOf(MessageContentInterface::class, $patch->content());
        self::assertInstanceOf(MessageContent::class, $patch->content());

        $patch = $this->newObjectTextMessageContent();
        self::assertInstanceOf(MessageContentInterface::class, $patch->content());
        self::assertInstanceOf(MessageContent::class, $patch->content());

        $patch = $this->newObjectTextHtmlContent();
        self::assertInstanceOf(MessageContentInterface::class, $patch->content());
        self::assertInstanceOf(TextHtmlContent::class, $patch->content());

        $patch = $this->newObjectFormData();
        self::assertInstanceOf(MessageContentInterface::class, $patch->content());
        self::assertInstanceOf(RawFormDataContent::class, $patch->content());

        $patch = $this->newObjectFormUrlEncoded();
        self::assertInstanceOf(MessageContentInterface::class, $patch->content());
        self::assertInstanceOf(FormUrlencodedData::class, $patch->content());

        $patch = $this->newObjectJsonMessageContent();
        self::assertInstanceOf(MessageContentInterface::class, $patch->content());
        self::assertInstanceOf(JsonMessageContent::class, $patch->content());

        $patch = $this->newObjectCustomMessageContent(new \ArrayIterator([1,10]));
        self::assertInstanceOf(MessageContentInterface::class, $patch->content());
        self::assertInstanceOf(MessageContent::class, $patch->content());
    }

    public function testData()
    {
        // Using FakeMessageContent as messageContent
        $patch = $this->newObjectFakeContent();
        self::assertNotNull($patch->data());
        self::assertIsString($patch->data());
        self::assertEmpty($patch->data());

        // Using MessageContent as messageContent
        $patch = $this->newObjectTextMessageContent();
        self::assertNotNull($patch->data());
        self::assertNotEmpty($patch->data());
        self::assertIsString($patch->data());
        self::assertContains('Text plain', $patch->data());

        // Using TextHtmlContent as messageContent
        $patch = $this->newObjectTextHtmlContent();
        self::assertNotNull($patch->data());
        self::assertNotEmpty($patch->data());
        self::assertIsString($patch->data());
        self::assertContains('<h1>Title</h1>', $patch->data());

        // Using FormDataContent as messageContent (only allowed $_POST source)
        $patch = $this->newObjectFormData();
        self::assertNotNull($patch->data());
        self::assertNotEmpty($patch->data());
        self::assertIsArray($patch->data());
        self::assertCount(FakeRawFormDataContent::DATA_COUNT, $patch->data());

        // Using FormUrlEncodedData as messageContent
        $patch = $this->newObjectFormUrlEncoded();
        $size = sizeof(FakeFormUrlencodedData::ARRAY_DATA);
        self::assertNotNull($patch->data());
        self::assertNotEmpty($patch->data());
        self::assertIsArray($patch->data());
        self::assertCount($size, $patch->data());

        // Using JsonMessageContent as messageContent
        $patch = $this->newObjectJsonMessageContent();
        self::assertNotNull($patch->data());
        self::assertNotEmpty($patch->data());
        self::assertIsObject($patch->data());
        self::assertInstanceOf(\stdClass::class, $patch->data());
        self::assertObjectHasAttribute('key', $patch->data());

        // Using a custom MessageContent as messageContent
        $arrayBase = [1, 2, 3];
        $patch = $this->newObjectCustomMessageContent(new \ArrayIterator($arrayBase));
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