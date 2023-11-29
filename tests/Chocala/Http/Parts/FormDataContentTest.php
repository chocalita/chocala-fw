<?php

namespace Chocala\Http\Parts;

use Chocala\System\ContentType;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class FormDataContentTest extends TestCase
{

    /**
     * @var string
     */
    private string $contentType;

    /**
     * @var string
     */
    private string $rawData;

    private function newObjectPost(): FormDataContent
    {
        $_POST = PostFormDataContentTest::ARRAY_VALUES;
        return new FormDataContent();
    }

    private function newObjectRawBody(): FormDataContent
    {
        return new FormDataContent($this->contentType, $this->rawData);
    }

    public function setUp()
    {
        $this->contentType = RawFormDataContentTest::contentType();
        $this->rawData = RawFormDataContentTest::rawData();
    }

    public function test__construct()
    {
        $formDataContent = new FormDataContent();
        self::assertIsObject($formDataContent);

        $formDataContent = new FormDataContent($this->contentType, $this->rawData);
        self::assertIsObject($formDataContent);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/Invalid number of arguments/');
        new FormDataContent($this->contentType);
    }

    public function testType()
    {
        $formDataContent = $this->newObjectPost();
        self::assertIsObject($formDataContent);
        self::assertNotEmpty($formDataContent->type());
        self::assertEquals(ContentType::MULTIPART_FORM_DATA, $formDataContent->type());
        self::assertNotEquals(ContentType::TEXT_PLAIN, $formDataContent->type());

        $formDataContent = $this->newObjectPost();
        self::assertIsObject($formDataContent);
        self::assertNotEmpty($formDataContent->type());
        self::assertEquals(ContentType::MULTIPART_FORM_DATA, $formDataContent->type());
        self::assertNotEquals(ContentType::TEXT_PLAIN, $formDataContent->type());
    }

    public function testData()
    {
        // $_POST empty array
        $_POST = [];
        $formDataContent = new FormDataContent();
        self::assertNotNull($formDataContent->data());
        self::assertEmpty($formDataContent->data());
        self::assertIsArray($formDataContent->data());
        self::assertCount(0, $formDataContent->data());

        // $_POST with test data
        $formDataContent = $this->newObjectPost();
        self::assertNotNull($formDataContent->data());
        self::assertNotEmpty($formDataContent->data());
        self::assertIsArray($formDataContent->data());
        self::assertCount(sizeof(PostFormDataContentTest::ARRAY_VALUES), $formDataContent->data());
        self::assertArrayHasKey('nullKey', $formDataContent->data());

        // Raw data empty value (with space case)
        $formDataContent = new FormDataContent($this->contentType, ' ');
        self::assertNotNull($formDataContent->data());
        self::assertEmpty($formDataContent->data());
        self::assertIsArray($formDataContent->data());
        self::assertCount(0, $formDataContent->data());

        // Raw data from 'raw_form-data' resource
        $formDataContent = $this->newObjectRawBody();
        self::assertNotNull($formDataContent->data());
        self::assertNotEmpty($formDataContent->data());
        self::assertIsArray($formDataContent->data());
        self::assertCount(4, $formDataContent->data());
        self::assertArrayHasKey('fruit', $formDataContent->data());
        self::assertArrayHasKey('has', $formDataContent->data());
        self::assertIsArray($formDataContent->data()['has']);
        self::assertCount(2, $formDataContent->data()['has']);

    }

}