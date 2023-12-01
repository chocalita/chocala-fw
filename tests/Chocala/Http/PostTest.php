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
        return $this->newObjectFakeBody();
    }

    private function newObjectFakeBody(): Post
    {
        $this->initQueryParams();
        return new Post(new FakeMessageBody());
    }

    private function newObjectCustomMessageBody($bodyContent): Post
    {
        $this->initQueryParams();
        return new Post(new FakeMessageBody($bodyContent));
    }

    private function newObjectTextMessageBody(): Post
    {
        return $this->newObjectCustomMessageBody($this->textContent());
    }

    private function newObjectTextHtmlBody(): Post
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

    private function newObjectJsonMessageBody(): Post
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

    public function testBody()
    {
        $post = $this->newObject();
        self::assertNotNull($post->body());
        self::assertIsObject($post->body());

        $post = $this->newObjectFakeBody();
        self::assertInstanceOf(MessageBodyInterface::class, $post->body());
        self::assertInstanceOf(MessageBody::class, $post->body());

        $post = $this->newObjectTextMessageBody();
        self::assertInstanceOf(MessageBodyInterface::class, $post->body());
        self::assertInstanceOf(MessageBody::class, $post->body());

        $post = $this->newObjectTextHtmlBody();
        self::assertInstanceOf(MessageBodyInterface::class, $post->body());
        self::assertInstanceOf(TextHtmlBody::class, $post->body());

        $post = $this->newObjectFormData();
        self::assertInstanceOf(MessageBodyInterface::class, $post->body());
        self::assertInstanceOf(PostFormDataBody::class, $post->body());

        $post = $this->newObjectFormUrlEncoded();
        self::assertInstanceOf(MessageBodyInterface::class, $post->body());
        self::assertInstanceOf(FormUrlencodedBody::class, $post->body());

        $post = $this->newObjectJsonMessageBody();
        self::assertInstanceOf(MessageBodyInterface::class, $post->body());
        self::assertInstanceOf(JsonMessageBody::class, $post->body());

        $post = $this->newObjectCustomMessageBody(new \ArrayIterator([1,10]));
        self::assertInstanceOf(MessageBodyInterface::class, $post->body());
        self::assertInstanceOf(MessageBody::class, $post->body());
    }

    public function testData()
    {
        // Using FakeMessageBody as messageBody
        $post = $this->newObjectFakeBody();
        self::assertNotNull($post->data());
        self::assertIsString($post->data());
        self::assertEmpty($post->data());

        // Using MessageBody as messageBody
        $post = $this->newObjectTextMessageBody();
        self::assertNotNull($post->data());
        self::assertNotEmpty($post->data());
        self::assertIsString($post->data());
        self::assertContains('Text plain', $post->data());

        // Using TextHtmlContent as messageBody
        $post = $this->newObjectTextHtmlBody();
        self::assertNotNull($post->data());
        self::assertNotEmpty($post->data());
        self::assertIsString($post->data());
        self::assertContains('<h1>Title</h1>', $post->data());

        // Using FormDataContent as messageBody (only allowed $_POST source)
        $post = $this->newObjectFormData();
        $size = sizeof(FakeFormDataBody::ARRAY_DATA);
        self::assertNotNull($post->data());
        self::assertNotEmpty($post->data());
        self::assertIsArray($post->data());
        self::assertCount($size, $post->data());

        // Using FormUrlEncodedData as messageBody
        $post = $this->newObjectFormUrlEncoded();
        $size = sizeof(FakeFormUrlencodedBody::ARRAY_DATA);
        self::assertNotNull($post->data());
        self::assertNotEmpty($post->data());
        self::assertIsArray($post->data());
        self::assertCount($size, $post->data());

        // Using JsonMessageBody as messageBody
        $post = $this->newObjectJsonMessageBody();
        self::assertNotNull($post->data());
        self::assertNotEmpty($post->data());
        self::assertIsObject($post->data());
        self::assertInstanceOf(\stdClass::class, $post->data());
        self::assertObjectHasAttribute('key', $post->data());

        // Using a custom MessageBody as messageBody
        $arrayBase = [1, 2, 3];
        $post = $this->newObjectCustomMessageBody(new \ArrayIterator($arrayBase));
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