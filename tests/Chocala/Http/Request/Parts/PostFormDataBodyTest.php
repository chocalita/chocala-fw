<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Base\IllegalStateException;
use Chocala\Http\Request\Parts\Fakes\FakeFormDataBody;
use Chocala\Http\Request\Parts\Fakes\FakePostFormDataBody;
use Chocala\System\ContentType;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PostFormDataBodyTest extends TestCase
{
    public function test__construct()
    {
        $postFormDataBody = new PostFormDataBody();
        self::assertIsObject($postFormDataBody);

        $postFormDataBody = new FakePostFormDataBody();
        self::assertIsObject($postFormDataBody);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/Too many arguments/');
        new PostFormDataBody([100]);
    }

    public function testType()
    {
        $postFormDataBody = new FakePostFormDataBody();
        self::assertIsObject($postFormDataBody);
        self::assertNotEmpty($postFormDataBody->type());
        self::assertEquals(ContentType::MULTIPART_FORM_DATA, $postFormDataBody->type());
        self::assertNotEquals(ContentType::TEXT_PLAIN, $postFormDataBody->type());
        self::assertNotEquals(ContentType::APPLICATION_FORM_URLENCODED, $postFormDataBody->type());
    }

    public function testData()
    {
        // $_POST empty array
        $_POST = [];
        $postFormDataBody = new PostFormDataBody();
        self::assertNotNull($postFormDataBody->data());
        self::assertEmpty($postFormDataBody->data());
        self::assertIsArray($postFormDataBody->data());
        self::assertCount(0, $postFormDataBody->data());

        // $_POST with test data
        $postFormDataBody = new FakePostFormDataBody();
        $size = sizeof(FakeFormDataBody::ARRAY_DATA);
        self::assertNotNull($postFormDataBody->data());
        self::assertNotEmpty($postFormDataBody->data());
        self::assertIsArray($postFormDataBody->data());
        self::assertCount($size, $postFormDataBody->data());
        self::assertArrayHasKey('nullKey', $postFormDataBody->data());
        self::assertNull($postFormDataBody->data()['nullKey']);
        self::assertArrayHasKey('numericKey', $postFormDataBody->data());
        self::assertIsNumeric($postFormDataBody->data()['numericKey']);
        self::assertArrayHasKey('arrayKey', $postFormDataBody->data());
        self::assertIsArray($postFormDataBody->data()['arrayKey']);
        $_POST['123'] = 123;
        self::assertCount($size + 1, $postFormDataBody->data());
        self::assertEquals(123, $postFormDataBody->data()['123']);
        unset($_POST['lastKey']);
        self::assertCount($size, $postFormDataBody->data());
    }

    public function testPOSTNullValue()
    {
        // Setting $_POST value to null before object creation
        $_POST = null;
        $this->expectException(IllegalStateException::class);
        $this->expectExceptionMessageRegExp('/resource is null/');
        $postFormDataBody = new PostFormDataBody();
        $postFormDataBody->data();
    }

    public function testPOSTSetToNullValue()
    {
        // Setting $_POST value to null after object creation
        $postFormDataBody = new PostFormDataBody();
        $this->expectException(IllegalStateException::class);
        $this->expectExceptionMessageRegExp('/resource is null/');
        $_POST = null;
        $postFormDataBody->data();
    }
}
