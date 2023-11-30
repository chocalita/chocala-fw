<?php

namespace Chocala\Http\Parts;

use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class FormDataContentTest extends TestCase
{


    public function test__construct()
    {
        $formDataContent = $this->newFormDataContentCustomClass();
        self::assertIsObject($formDataContent);
    }

    public function testType()
    {
        $formDataContent = $this->newFormDataContentCustomClass();
        self::assertIsObject($formDataContent);
        self::assertNotEmpty($formDataContent->type());
        self::assertEquals(ContentType::MULTIPART_FORM_DATA, $formDataContent->type());
        self::assertNotEquals(ContentType::TEXT_PLAIN, $formDataContent->type());
    }

    public function testData()
    {
        $formDataContent = $this->newFormDataContentCustomClass();
        self::assertNotNull($formDataContent->data());
        self::assertEmpty($formDataContent->data());
        self::assertIsArray($formDataContent->data());
        self::assertCount(0, $formDataContent->data());
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