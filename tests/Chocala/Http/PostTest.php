<?php

namespace Chocala\Http;

require_once 'HttpMethodTest.php';

class PostTest extends HttpMethodTest
{

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

    public function testData()
    {
        $post = $this->newObject();
        $size = sizeof($this->arrayValue());
        self::assertNotEmpty($post->data());
        self::assertCount($size, $post->data());
        $_POST['123'] = 123;
        self::assertCount($size + 1, $post->data());
        self::assertEquals(123, $post->get('123'));
        unset($_POST['lastKey']);
        self::assertCount($size, $post->data());
    }

    public function testHas()
    {
        $post = $this->newObject();
        self::assertIsBool($post->has('var0'));
        self::assertIsBool($post->has('INVALID_KEY'));
        self::assertTrue($post->has('var0'));
        self::assertFalse($post->has('INVALID_KEY'));
    }

    public function testGet()
    {
        $post = $this->newObject();
        self::assertNull($post->get('INVALID_KEY'));
        self::assertEquals('zero', $post->get('var0'));
        self::assertIsNumeric($post->get('numericKey'));
        self::assertIsArray($post->get('arrayKey'));
        self::assertNull($post->get('nullKey'));
        self::assertEquals('DEFAULT_VALUE', $post->get('DEFAULT_01234XYZ', 'DEFAULT_VALUE'));
    }

    public function testDelete()
    {
        $post = $this->newObject();
        $size = sizeof($this->arrayValue());
        self::assertCount($size, $post->data());
        $post->delete('removedKey');
        self::assertCount($size - 1, $post->data());
        self::assertEquals($post, $post->delete('INVALID_KEY'));
        self::assertCount($size - 1, $post->data());
    }

    public function testExtract()
    {
        $post = $this->newObject();
        $size = sizeof($this->arrayValue());
        self::assertCount($size, $post->data());
        self::assertEquals('extractedValue', $post->extract('extractedKey'));
        self::assertCount($size - 1, $post->data());
        self::assertNull($post->extract('INVALID_KEY'));
        self::assertCount($size - 1, $post->data());
    }

    public function testBody()
    {
        $post = $this->newObject();
        //TODO: create tests
        self::assertEmpty($post->body());
    }

    private function newObject()
    {
        $_POST = $this->arrayValue();
        return new Post();
    }

}