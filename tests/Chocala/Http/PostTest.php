<?php

namespace Chocala\Http;

use Chocala\Http\Parts\Fakes\FakeMessageContent;
use Chocala\Http\Parts\FormUrlencodedData;

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

    private function newObjectFormUrlEncoded(): Post
    {
        $this->initParams();
        $queryString = $this->arrayToQueryString($this->arrayFormData());
        return new Post(new FormUrlencodedData($queryString));
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

    public function testContent()
    {
        $post = $this->newObject();
        self::assertNotNull($post->content());
        self::assertIsObject($post->content());
    }

    public function testData()
    {
        // Using FakeMessageContent as messageContent
        $post = $this->newObjectFakeContent();
        self::assertNotNull($post->data());
        self::assertIsString($post->data());
        self::assertEmpty($post->data());

        // Using FormUrlEncodedData as messageContent
        $post = $this->newObjectFormUrlEncoded();
        $size = sizeof($this->arrayFormData());
        self::assertNotNull($post->data());
        self::assertIsArray($post->data());
        self::assertNotEmpty($post->data());
        self::assertCount($size, $post->data());

    }

}