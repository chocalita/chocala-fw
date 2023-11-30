<?php

namespace Chocala\Http;

use Chocala\Base\IllegalArgumentException;
use Chocala\Http\Parts\Fakes\FakeMessageContent;
use Chocala\Http\Parts\Fakes\FakePostFormDataContent;
use Chocala\Http\Parts\Fakes\FakeQueryParams;
use Chocala\Http\Parts\Fakes\FakeRawFormDataContent;
use Chocala\Http\Parts\FormUrlencodedData;
use Chocala\Http\Parts\JsonMessageContent;
use Chocala\Http\Parts\MessageContent;
use Chocala\Http\Parts\MessageContentInterface;
use Chocala\Http\Parts\PostFormDataContent;
use Chocala\Http\Parts\QueryParamsInterface;
use Chocala\Http\Parts\TextHtmlContent;
use Chocala\System\ContentType;
use InvalidArgumentException;

require_once 'HttpMethodTest.php';
require_once __DIR__ . '/Parts/PostFormDataContentTest.php';
require_once __DIR__ . '/Parts/RawFormDataContentTest.php';

class PostTest extends HttpMethodTest
{

    private function initQueryParams()
    {
        $_GET = $this->arrayQueryParams();
    }

    private function newObject(): Post
    {
        return $this->newObjectFakeContent();
    }

    private function newObjectFakeContent(): Post
    {
        $this->initQueryParams();
        return new Post(new FakeMessageContent());
    }

    private function newObjectCustomMessageContent($bodyContent): Post
    {
        $this->initQueryParams();
        return new Post(new MessageContent(ContentType::TEXT_PLAIN, $bodyContent));
    }

    private function newObjectTextMessageContent(): Post
    {
        return $this->newObjectCustomMessageContent($this->textContent());
    }

    private function newObjectTextHtmlContent(): Post
    {
        $this->initQueryParams();
        $bodyContent = $this->htmlContent();
        return new Post(new TextHtmlContent($bodyContent));
    }

    private function newObjectFormData(): Post
    {
        $this->initQueryParams();
        $_POST = $this->arrayFormData();
        return new Post(new FakePostFormDataContent());
    }

    private function newObjectFormUrlEncoded(): Post
    {
        $this->initQueryParams();
        $bodyContent = $this->arrayToQueryString($this->arrayFormData());
        return new Post(new FormUrlencodedData($bodyContent));
    }

    private function newObjectJsonMessageContent(): Post
    {
        $this->initQueryParams();
        $bodyContent = $this->jsonContent();
        return new Post(new JsonMessageContent($bodyContent));
    }

    public function test__construct()
    {
        $post = new Post(new FakeMessageContent());
        self::assertIsObject($post);

        $post = new Post(new FakeQueryParams(), new FakeMessageContent());
        self::assertIsObject($post);

        $this->expectException(IllegalArgumentException::class);
        $this->expectExceptionMessageRegExp('/does not support raw-data body/');
        new Post(new FakeRawFormDataContent());
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
        self::assertInstanceOf(MessageContentInterface::class, $post->content());
        self::assertInstanceOf(FakeMessageContent::class, $post->content());

        $post = $this->newObjectTextMessageContent();
        self::assertInstanceOf(MessageContentInterface::class, $post->content());
        self::assertInstanceOf(MessageContent::class, $post->content());

        $post = $this->newObjectTextHtmlContent();
        self::assertInstanceOf(MessageContentInterface::class, $post->content());
        self::assertInstanceOf(TextHtmlContent::class, $post->content());

        $post = $this->newObjectFormData();
        self::assertInstanceOf(MessageContentInterface::class, $post->content());
        self::assertInstanceOf(PostFormDataContent::class, $post->content());

        $post = $this->newObjectFormUrlEncoded();
        self::assertInstanceOf(MessageContentInterface::class, $post->content());
        self::assertInstanceOf(FormUrlencodedData::class, $post->content());

        $post = $this->newObjectJsonMessageContent();
        self::assertInstanceOf(MessageContentInterface::class, $post->content());
        self::assertInstanceOf(JsonMessageContent::class, $post->content());

        $post = $this->newObjectCustomMessageContent(new \ArrayIterator([1,10]));
        self::assertInstanceOf(MessageContentInterface::class, $post->content());
        self::assertInstanceOf(MessageContent::class, $post->content());
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
        $size = sizeof($this->arrayFormData());
        self::assertNotNull($post->data());
        self::assertNotEmpty($post->data());
        self::assertIsArray($post->data());
        self::assertCount($size, $post->data());

        // Using FormUrlEncodedData as messageContent
        $post = $this->newObjectFormUrlEncoded();
        $size = sizeof($this->arrayFormData());
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