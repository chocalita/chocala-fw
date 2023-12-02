<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\Http\Parts\Fakes\FakeBoundariedFormDataBody;
use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class RawFormDataBodyTest extends TestCase
{

    protected const RESOURCES_DIR = __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR;

    /**
     * @var string
     */
    private string $contentType;

    /**
     * @var string
     */
    private string $rawData;

    public function setUp()
    {
        $this->contentType = FakeBoundariedFormDataBody::contentType();
        $this->rawData = FakeBoundariedFormDataBody::rawData();
    }

    public function test__construct()
    {
        $rawFormDataBody = new BoundariedFormDataBody($this->contentType, $this->rawData);
        self::assertIsObject($rawFormDataBody);

        // Empty raw data with empty string
        $rawFormDataBody = new BoundariedFormDataBody($this->contentType, '');
        self::assertIsObject($rawFormDataBody);

        // Empty raw data with spaces
        $rawFormDataBody = new BoundariedFormDataBody($this->contentType, '  ');
        self::assertIsObject($rawFormDataBody);

        // Empty raw data with new lines
        $rawFormDataBody = new BoundariedFormDataBody($this->contentType, ' 

        ');
        self::assertIsObject($rawFormDataBody);

        $this->expectException(IllegalArgumentException::class);
        $this->expectExceptionCode(31);
        $this->expectExceptionMessageRegExp('/Invalid/');
        new BoundariedFormDataBody('', '');
    }

    public function testType()
    {
        $rawFormDataBody = new BoundariedFormDataBody($this->contentType, ' ');
        self::assertIsObject($rawFormDataBody);
        self::assertNotEmpty($rawFormDataBody->type());
        self::assertEquals(ContentType::MULTIPART_FORM_DATA, $rawFormDataBody->type());
        self::assertNotEquals(ContentType::TEXT_PLAIN, $rawFormDataBody->type());

        $rawFormDataBody = new FakeBoundariedFormDataBody();
        self::assertIsObject($rawFormDataBody);
        self::assertNotEmpty($rawFormDataBody->type());
        self::assertEquals(ContentType::MULTIPART_FORM_DATA, $rawFormDataBody->type());
        self::assertNotEquals(ContentType::APPLICATION_FORM_URLENCODED, $rawFormDataBody->type());
    }

    public function testData()
    {
        // Raw data empty value (with space case)
        $rawFormDataBody = new BoundariedFormDataBody($this->contentType, ' ');
        self::assertNotNull($rawFormDataBody->data());
        self::assertEmpty($rawFormDataBody->data());
        self::assertIsArray($rawFormDataBody->data());
        self::assertCount(0, $rawFormDataBody->data());

        // Raw data from 'raw_form-data' resource
        $rawFormDataBody = new FakeBoundariedFormDataBody();
        self::assertNotNull($rawFormDataBody->data());
        self::assertNotEmpty($rawFormDataBody->data());
        self::assertIsArray($rawFormDataBody->data());
        self::assertCount(4, $rawFormDataBody->data());
        self::assertArrayHasKey('fruit', $rawFormDataBody->data());
        self::assertNotEmpty($rawFormDataBody->data()['fruit']);
        self::assertEquals('lemon', $rawFormDataBody->data()['fruit']);
        self::assertArrayHasKey('quantity', $rawFormDataBody->data());
        self::assertEquals(10, $rawFormDataBody->data()['quantity']);
        self::assertNotSame(10, $rawFormDataBody->data()['quantity']);
        self::assertSame('10', $rawFormDataBody->data()['quantity']);
        self::assertArrayHasKey('has', $rawFormDataBody->data());
        self::assertIsArray($rawFormDataBody->data()['has']);
        self::assertNotEmpty($rawFormDataBody->data()['has']);
        self::assertCount(2, $rawFormDataBody->data()['has']);

        // TODO: support begin or end strings
        //$bod = new RawFormDataContent($this->contentType, 'multipart/form-data' . $this->rawFormData);

        $this->expectException(IllegalArgumentException::class);
        $bod = new BoundariedFormDataBody($this->contentType, 'multipart/form-data; ');
    }

    // Invalid content type
    public function testInvalidContentType()
    {
        $this->expectException(IllegalArgumentException::class);
        $this->expectExceptionCode(31);
        $this->expectExceptionMessageRegExp('/Invalid multipart\/form-data, Content-Type is not matching/');
        new BoundariedFormDataBody('multipart/form-data; ', $this->rawData);
    }

    // Invalid case: invalid raw data
    public function testInvalidRawData()
    {
        $this->expectException(IllegalArgumentException::class);
        $this->expectExceptionCode(31);
        $this->expectExceptionMessageRegExp('/Invalid multipart\/form-data/');
        new BoundariedFormDataBody($this->contentType, ' - ');
    }

    // Content has a txt file
    public function testFormDataWithTxtFile()
    {
        $rawFormDataBody = new FakeBoundariedFormDataBody('738248700975810852557521', 'raw_form-data_txt_file');
        self::assertIsObject($rawFormDataBody);
        self::assertEquals(ContentType::MULTIPART_FORM_DATA, $rawFormDataBody->type());
        self::assertIsArray($rawFormDataBody->data());
        self::assertNotEmpty($rawFormDataBody->data());
    }

    // Content has a zip file
    public function testFormDataWithZipFile()
    {
        $rawFormDataBody = new FakeBoundariedFormDataBody('365774502836687403390313', 'raw_form-data_zip_file');
        self::assertIsObject($rawFormDataBody);
        self::assertEquals(ContentType::MULTIPART_FORM_DATA, $rawFormDataBody->type());
        self::assertIsArray($rawFormDataBody->data());
        self::assertNotEmpty($rawFormDataBody->data());
    }

    public function testInvalidNumericBody()
    {
        $this->expectException(IllegalArgumentException::class);
        $this->expectExceptionMessageRegExp('/Invalid multipart\/form-data raw data/');
        new BoundariedFormDataBody($this->contentType, 123);
    }

}