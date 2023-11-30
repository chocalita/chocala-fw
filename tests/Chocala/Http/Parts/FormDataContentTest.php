<?php

namespace Chocala\Http\Parts;

use Chocala\Http\Parts\Fakes\FakeFormDataContent;
use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class FormDataContentTest extends TestCase
{

    public function test__construct()
    {
        $formDataContent = new FakeFormDataContent();
        self::assertIsObject($formDataContent);

        // Another implementation (ase class is abstract)
        $formDataContent = $this->newFormDataContentCustomClass();
        self::assertIsObject($formDataContent);
    }

    public function testType()
    {
        $formDataContent = new FakeFormDataContent();
        self::assertIsObject($formDataContent);
        self::assertNotEmpty($formDataContent->type());
        self::assertEquals(ContentType::MULTIPART_FORM_DATA, $formDataContent->type());
        self::assertNotEquals(ContentType::TEXT_PLAIN, $formDataContent->type());
    }

    public function testData()
    {
        $formDataContent = new FakeFormDataContent();
        $size = sizeof(FakeFormDataContent::ARRAY_DATA);
        self::assertNotNull($formDataContent->data());
        self::assertNotEmpty($formDataContent->data());
        self::assertIsArray($formDataContent->data());
        self::assertCount($size, $formDataContent->data());
    }

    private function newFormDataContentCustomClass(): FormDataContent
    {
        $formDataContent = new class() extends FormDataContent {

            public function __construct()
            {
                parent::__construct();
                $this->data = [];
            }

        };
        return new $formDataContent();
    }

}