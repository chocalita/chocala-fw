<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Http\Request\Parts\Fakes\FakeFormDataBody;
use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class FormDataBodyTest extends TestCase
{
    public function test__construct()
    {
        $formDataBody = new FakeFormDataBody();
        self::assertIsObject($formDataBody);

        // Another implementation (ase class is abstract)
        $formDataBody = $this->newFormDataContentCustomClass();
        self::assertIsObject($formDataBody);
    }

    public function testType()
    {
        $formDataBody = new FakeFormDataBody();
        self::assertIsObject($formDataBody);
        self::assertNotEmpty($formDataBody->type());
        self::assertEquals(ContentType::MULTIPART_FORM_DATA, $formDataBody->type());
        self::assertNotEquals(ContentType::TEXT_PLAIN, $formDataBody->type());
    }

    public function testData()
    {
        $formDataBody = new FakeFormDataBody();
        $size = sizeof(FakeFormDataBody::ARRAY_DATA);
        self::assertNotNull($formDataBody->data());
        self::assertNotEmpty($formDataBody->data());
        self::assertIsArray($formDataBody->data());
        self::assertCount($size, $formDataBody->data());
    }

    private function newFormDataContentCustomClass(): FormDataBody
    {
        $formDataBody = new class () extends FormDataBody implements MessageBodyInterface {
            public function __construct()
            {
                parent::__construct(
                    []
                );
            }
        };
        return new $formDataBody();
    }
}
