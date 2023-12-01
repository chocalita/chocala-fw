<?php

namespace Chocala\Http;

use Chocala\Base\IllegalArgumentException;
use Chocala\Http\Parts\Fakes\FakeFormDataBody;
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
use Chocala\Http\Parts\PostFormDataBody;
use Chocala\Http\Parts\QueryParamsInterface;
use Chocala\Http\Parts\TextHtmlBody;
use InvalidArgumentException;

require_once 'HttpMethodTest.php';

class PostTest extends HttpMethodTest
{

    private function newObject(): Post
    {
        return $this->newObjectFakeContent();
    }

    private function newObjectFakeContent(): Post
    {
        $this->initQueryParams();
        return new Post(new FakeMessageBody());
    }

    private function newObjectCustomMessageContent($bodyContent): Post
    {
        $this->initQueryParams();
        return new Post(new FakeMessageBody($bodyContent));
    }

    private function newObjectTextMessageContent(): Post
    {
        return $this->newObjectCustomMessageContent($this->textContent());
    }

    private function newObjectTextHtmlContent(): Post
    {
        $this->initQueryParams();
        return new Post(new FakeTextHtmlBody());
    }

    private function newObjectFormData(): Post
    {
        $this->initQueryParams();
        return new Post(new FakePostFormDataBody());
    }

    private function newObjectFormUrlEncoded(): Post
    {
        $this->initQueryParams();
        return new Post(new FakeFormUrlencodedBody());
    }

    private function newObjectJsonMessageContent(): Post
    {
        $this->initQueryParams();
        return new Post(new FakeJsonMessageBody());
    }

    public function test__construct()
    {
        $post = new Post(new FakeMessageBody());
        self::assertIsObject($post);

        $post = new Post(new FakeQueryParams(), new FakeMessageBody());
        self::assertIsObject($post);

        $this->expectException(IllegalArgumentException::class);
        $this->expectExceptionMessageRegExp('/does not support raw-data body/');
        new Post(new FakeRawFormDataBody());
    }

    public function testName()
    {
        $post = $this->newObject();
        self::assertIsObject($post);
        self::assertEquals(HttpMethod::POST, $post->name());
    }

    public function testId()
    {
        $post = $this->newObject();
        self::assertNotNull($post->id());
        self::assertGreaterThan(8, strlen($post->id()));
    }

    public function testQueryParams()
    {
        $post = $this->newObject();
        $size = sizeof($this->arrayQueryParams());
        self::assertNotNull($post->queryParams());
        self::assertIsObject($post->queryParams());
        self::assertInstanceOf(QueryParamsInterface::class, $post->queryParams());
        self::assertCount($size, $post->queryParams()->data());
        unset($_GET['lastKey']);
        self::assertCount($size-1, $post->queryParams()->data());
    }

    public function testContent()
    {
        $post = $this->newObject();
        self::assertNotNull($post->content());
        self::assertIsObject($post->content());

        $post = $this->newObjectFakeContent();
        self::assertInstanceOf(MessageBodyInterface::class, $post->content());
        self::assertInstanceOf(MessageBody::class, $post->content());

        $post = $this->newObjectTextMessageContent();
        self::assertInstanceOf(MessageBodyInterface::class, $post->content());
        self::assertInstanceOf(MessageBody::class, $post->content());

        $post = $this->newObjectTextHtmlContent();
        self::assertInstanceOf(MessageBodyInterface::class, $post->content());
        self::assertInstanceOf(TextHtmlBody::class, $post->content());

        $post = $this->newObjectFormData();
        self::assertInstanceOf(MessageBodyInterface::class, $post->content());
        self::assertInstanceOf(PostFormDataBody::class, $post->content());

        $post = $this->newObjectFormUrlEncoded();
        self::assertInstanceOf(MessageBodyInterface::class, $post->content());
        self::assertInstanceOf(FormUrlencodedBody::class, $post->content());

        $post = $this->newObjectJsonMessageContent();
        self::assertInstanceOf(MessageBodyInterface::class, $post->content());
        self::assertInstanceOf(JsonMessageBody::class, $post->content());

        $post = $this->newObjectCustomMessageContent(new \ArrayIterator([1,10]));
        self::assertInstanceOf(MessageBodyInterface::class, $post->content());
        self::assertInstanceOf(MessageBody::class, $post->content());
    }

    public function testData()
    {
        // Using FakeMessageContent as messageContent
        $post = $this->newObjectFakeContent();
        self::assertNotNull($post->data());
        self::assertIsString($post->data());
        self::assertEmpty($post->data());

        // Using MessageContent as messageContent
        $post = $this->newObjectTextMessageContent();
        self::assertNotNull($post->data());
        self::assertNotEmpty($post->data());
        self::assertIsString($post->data());
        self::assertContains('Text plain', $post->data());

        // Using TextHtmlContent as messageContent
        $post = $this->newObjectTextHtmlContent();
        self::assertNotNull($post->data());
        self::assertNotEmpty($post->data());
        self::assertIsString($post->data());
        self::assertContains('<h1>Title</h1>', $post->data());

        // Using FormDataContent as messageContent (only allowed $_POST source)
        $post = $this->newObjectFormData();
        $size = sizeof(FakeFormDataBody::ARRAY_DATA);
        self::assertNotNull($post->data());
        self::assertNotEmpty($post->data());
        self::assertIsArray($post->data());
        self::assertCount($size, $post->data());

        // Using FormUrlEncodedData as messageContent
        $post = $this->newObjectFormUrlEncoded();
        $size = sizeof(FakeFormUrlencodedBody::ARRAY_DATA);
        self::assertNotNull($post->data());
        self::assertNotEmpty($post->data());
        self::assertIsArray($post->data());
        self::assertCount($size, $post->data());

        // Using JsonMessageContent as messageContent
        $post = $this->newObjectJsonMessageContent();
        self::assertNotNull($post->data());
        self::assertNotEmpty($post->data());
        self::assertIsObject($post->data());
        self::assertInstanceOf(\stdClass::class, $post->data());
        self::assertObjectHasAttribute('key', $post->data());

        // Using a custom MessageContent as messageContent
        $arrayBase = [1, 2, 3];
        $post = $this->newObjectCustomMessageContent(new \ArrayIterator($arrayBase));
        self::assertNotNull($post->data());
        self::assertNotEmpty($post->data());
        self::assertIsNotArray($post->data());
        self::assertIsObject($post->data());
        self::assertInstanceOf(\ArrayIterator::class, $post->data());
        self::assertSameSize($arrayBase, $post->data());
        self::assertEquals(1, $post->data()->offsetGet(0));
        self::assertEquals(2, $post->data()->offsetGet(1));
        self::assertEquals(3, $post->data()->offsetGet(2));
    }

    public function testConstructWithoutArgs()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/Invalid number of arguments/');
        new Post();
    }

}