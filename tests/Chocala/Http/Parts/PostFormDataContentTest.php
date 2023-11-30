<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalStateException;
use Chocala\Http\Parts\Fakes\FakePostFormDataContent;
use Chocala\System\ContentType;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PostFormDataContentTest extends TestCase
{

    public const ARRAY_VALUES = [
        'var0' => 'zero',
        'numericKey' => 789,
        'arrayKey' => [],
        'nullKey' => null,
        'toRemoveKey' => 'toRemoveValue',
        'extractedKey' => 'extractedValue',
        'lastKey' => 'last'
    ];

    public function test__construct()
    {
        $postFormDataContent = new PostFormDataContent();
        self::assertIsObject($postFormDataContent);

        $postFormDataContent = new FakePostFormDataContent();
        self::assertIsObject($postFormDataContent);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/Too many arguments/');
        new PostFormDataContent([100]);
    }

    public function testType()
    {
        $postFormDataContent = new FakePostFormDataContent();
        self::assertIsObject($postFormDataContent);
        self::assertNotEmpty($postFormDataContent->type());
        self::assertEquals(ContentType::MULTIPART_FORM_DATA, $postFormDataContent->type());
        self::assertNotEquals(ContentType::TEXT_PLAIN, $postFormDataContent->type());
        self::assertNotEquals(ContentType::APPLICATION_FORM_URLENCODED, $postFormDataContent->type());
    }

    public function testData()
    {
        // $_POST empty array
        $_POST = [];
        $postFormDataContent = new PostFormDataContent();
        self::assertNotNull($postFormDataContent->data());
        self::assertEmpty($postFormDataContent->data());
        self::assertIsArray($postFormDataContent->data());
        self::assertCount(0, $postFormDataContent->data());

        // $_POST with test data
        $postFormDataContent = new FakePostFormDataContent();
        $size = sizeof(self::ARRAY_VALUES);
        self::assertNotNull($postFormDataContent->data());
        self::assertNotEmpty($postFormDataContent->data());
        self::assertIsArray($postFormDataContent->data());
        self::assertCount($size, $postFormDataContent->data());
        self::assertArrayHasKey('nullKey', $postFormDataContent->data());
        self::assertNull($postFormDataContent->data()['nullKey']);
        self::assertArrayHasKey('numericKey', $postFormDataContent->data());
        self::assertIsNumeric($postFormDataContent->data()['numericKey']);
        self::assertArrayHasKey('arrayKey', $postFormDataContent->data());
        self::assertIsArray($postFormDataContent->data()['arrayKey']);
        $_POST['123'] = 123;
        self::assertCount($size + 1, $postFormDataContent->data());
        self::assertEquals(123, $postFormDataContent->data()['123']);
        unset($_POST['lastKey']);
        self::assertCount($size, $postFormDataContent->data());
    }

    public function testPOSTNullValue() {
        // Setting $_POST value to null before object creation
        $_POST = null;
        $this->expectException(IllegalStateException::class);
        $this->expectExceptionMessageRegExp('/resource is null/');
        $postFormDataContent = new PostFormDataContent();
        $postFormDataContent->data();
    }

    public function testPOSTSetToNullValue() {
        // Setting $_POST value to null after object creation
        $postFormDataContent = new PostFormDataContent();
        $this->expectException(IllegalStateException::class);
        $this->expectExceptionMessageRegExp('/resource is null/');
        $_POST = null;
        $postFormDataContent->data();
    }

}