<?php

namespace Chocala\Http;

use Chocala\Http\Parts\Fakes\FakeMessageContent;
use Chocala\Http\Parts\FormUrlencodedData;
use Chocala\Http\Parts\JsonMessageContent;
use Chocala\Http\Parts\MessageContent;
use Chocala\Http\Parts\MessageContentInterface;
use Chocala\Http\Parts\QueryParamsInterface;
use Chocala\Http\Parts\TextHtmlContent;
use Chocala\System\ContentType;

require_once 'HttpMethodTest.php';

class PostTest extends HttpMethodTest
{

    private function initParams()
    {
        $_GET = $this->arrayQueryParams();
        $_POST = $this->arrayFormData();
    }

    private function newObject(): Post
    {
        return $this->newObjectFakeContent();
    }

    private function newObjectFakeContent(): Post
    {
        $this->initParams();
        return new Post(new FakeMessageContent());
    }

    private function newObjectCustomMessageContent($bodyContent): Post
    {
        $this->initParams();
        return new Post(new MessageContent(ContentType::TEXT_PLAIN, $bodyContent));
    }

    private function newObjectTextMessageContent(): Post
    {
        return $this->newObjectCustomMessageContent($this->textContent());
    }

    private function newObjectTextHtmlContent(): Post
    {
        $this->initParams();
        $bodyContent = $this->htmlContent();
        return new Post(new TextHtmlContent($bodyContent));
    }

    private function newObjectJsonMessageContent(): Post
    {
        $this->initParams();
        $bodyContent = $this->jsonContent();
        return new Post(new JsonMessageContent($bodyContent));
    }

    private function newObjectFormUrlEncoded(): Post
    {
        $this->initParams();
        $bodyContent = $this->arrayToQueryString($this->arrayFormData());
        return new Post(new FormUrlencodedData($bodyContent));
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
        $get = $this->newObject();
        $size = sizeof($this->arrayQueryParams());
        self::assertNotNull($get->queryParams());
        self::assertIsObject($get->queryParams());
        self::assertInstanceOf(QueryParamsInterface::class, $get->queryParams());
        self::assertCount($size, $get->queryParams()->data());
        unset($_GET['lastKey']);
        self::assertCount($size-1, $get->queryParams()->data());
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

        $post = $this->newObjectJsonMessageContent();
        self::assertInstanceOf(MessageContentInterface::class, $post->content());
        self::assertInstanceOf(JsonMessageContent::class, $post->content());

        $post = $this->newObjectFormUrlEncoded();
        self::assertInstanceOf(MessageContentInterface::class, $post->content());
        self::assertInstanceOf(FormUrlencodedData::class, $post->content());

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

        // Using JsonMessageContent as messageContent
        $post = $this->newObjectJsonMessageContent();
        self::assertNotNull($post->data());
        self::assertNotEmpty($post->data());
        self::assertIsObject($post->data());
        self::assertInstanceOf(\stdClass::class, $post->data());
        self::assertObjectHasAttribute('key', $post->data());

        // Using FormUrlEncodedData as messageContent
        $post = $this->newObjectFormUrlEncoded();
        $size = sizeof($this->arrayFormData());
        self::assertNotNull($post->data());
        self::assertNotEmpty($post->data());
        self::assertIsArray($post->data());
        self::assertCount($size, $post->data());

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

}