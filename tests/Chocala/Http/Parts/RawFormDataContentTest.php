<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class RawFormDataContentTest extends TestCase
{

    protected const RESOURCES_DIR = __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR;

    /**
     * @var string
     */
    private string $contentType;

    /**
     * @var string
     */
    private string $contentTypeTxtFile;

    /**
     * @var string
     */
    private string $contentTypeZipFile;

    /**
     * @var string
     */
    private string $rawData;

    /**
     * @var string
     */
    private string $rawDataTxtFile;

    /**
     * @var string
     */
    private string $rawDataZipFile;

    public static function contentType() : string
    {
        return 'multipart/form-data; boundary=--------------------------852526859393702478530519';
    }

    public static function rawData() : string
    {
        return file_get_contents(self::RESOURCES_DIR . 'raw_form-data');
    }

    public function setUp()
    {
        $this->contentType = self::contentType();
        $this->contentTypeTxtFile = 'multipart/form-data; boundary=--------------------------738248700975810852557521';
        $this->contentTypeZipFile = 'multipart/form-data; boundary=--------------------------365774502836687403390313';
        $this->rawData = self::rawData();
        $this->rawDataTxtFile = file_get_contents(self::RESOURCES_DIR . 'raw_form-data_txt_file');
        $this->rawDataZipFile = file_get_contents(self::RESOURCES_DIR . 'raw_form-data_zip_file');
    }

    public function test__construct()
    {
        $rawFormDataContent = new RawFormDataContent($this->contentType, $this->rawData);
        self::assertIsObject($rawFormDataContent);

        // Empty raw data with empty string
        $rawFormDataContent = new RawFormDataContent($this->contentType, '');
        self::assertIsObject($rawFormDataContent);

        // Empty raw data with spaces
        $rawFormDataContent = new RawFormDataContent($this->contentType, '  ');
        self::assertIsObject($rawFormDataContent);

        // Empty raw data with new lines
        $rawFormDataContent = new RawFormDataContent($this->contentType, ' 

        ');
        self::assertIsObject($rawFormDataContent);

        $this->expectException(IllegalArgumentException::class);
        $this->expectExceptionCode(31);
        $this->expectExceptionMessageRegExp('/Invalid/');
        new RawFormDataContent('', '');
    }

    public function testType()
    {
        $rawFormDataContent = new RawFormDataContent($this->contentType, ' ');
        self::assertIsObject($rawFormDataContent);
        self::assertNotEmpty($rawFormDataContent->type());
        self::assertEquals(ContentType::MULTIPART_FORM_DATA, $rawFormDataContent->type());
        self::assertNotEquals(ContentType::TEXT_PLAIN, $rawFormDataContent->type());

        $rawFormDataContent = new RawFormDataContent($this->contentType, $this->rawData);
        self::assertIsObject($rawFormDataContent);
        self::assertNotEmpty($rawFormDataContent->type());
        self::assertEquals(ContentType::MULTIPART_FORM_DATA, $rawFormDataContent->type());
        self::assertNotEquals(ContentType::APPLICATION_FORM_URLENCODED, $rawFormDataContent->type());
    }

    public function testData()
    {
        // Raw data empty value (with space case)
        $rawFormDataContent = new RawFormDataContent($this->contentType, ' ');
        self::assertNotNull($rawFormDataContent->data());
        self::assertEmpty($rawFormDataContent->data());
        self::assertIsArray($rawFormDataContent->data());
        self::assertCount(0, $rawFormDataContent->data());

        // Raw data from 'raw_form-data' resource
        $rawFormDataContent = new RawFormDataContent($this->contentType, $this->rawData);
        self::assertNotNull($rawFormDataContent->data());
        self::assertNotEmpty($rawFormDataContent->data());
        self::assertIsArray($rawFormDataContent->data());
        self::assertCount(4, $rawFormDataContent->data());
        self::assertArrayHasKey('fruit', $rawFormDataContent->data());
        self::assertNotEmpty($rawFormDataContent->data()['fruit']);
        self::assertEquals('lemon', $rawFormDataContent->data()['fruit']);
        self::assertArrayHasKey('quantity', $rawFormDataContent->data());
        self::assertEquals(10, $rawFormDataContent->data()['quantity']);
        self::assertNotSame(10, $rawFormDataContent->data()['quantity']);
        self::assertSame('10', $rawFormDataContent->data()['quantity']);
        self::assertArrayHasKey('has', $rawFormDataContent->data());
        self::assertIsArray($rawFormDataContent->data()['has']);
        self::assertNotEmpty($rawFormDataContent->data()['has']);
        self::assertCount(2, $rawFormDataContent->data()['has']);

        // TODO: support begin or end strings
        //$bod = new RawFormDataContent($this->contentType, 'multipart/form-data' . $this->rawFormData);

        $this->expectException(IllegalArgumentException::class);
        $bod = new RawFormDataContent($this->contentType, 'multipart/form-data; ');
    }

    // Invalid content type
    public function testInvalidContentType()
    {
        $this->expectException(IllegalArgumentException::class);
        $this->expectExceptionCode(31);
        $this->expectExceptionMessageRegExp('/Invalid multipart\/form-data, Content-Type is not matching/');
        new RawFormDataContent('multipart/form-data; ', $this->rawData);
    }

    // Invalid case: invalid raw data
    public function testInvalidRawData()
    {
        $this->expectException(IllegalArgumentException::class);
        $this->expectExceptionCode(31);
        $this->expectExceptionMessageRegExp('/Invalid multipart\/form-data/');
        new RawFormDataContent($this->contentType, ' - ');
    }

    // Invalid case: content has a txt file
    public function testInvalidFormDataTxtFile()
    {
        $this->expectException(IllegalArgumentException::class);
        $this->expectExceptionCode(31);
        $this->expectExceptionMessageRegExp('/Invalid multipart\/form-data/');
        new RawFormDataContent($this->contentType, $this->rawDataTxtFile);
    }

    // Invalid case: content has a zip file
    public function testInvalidFormDataZipFile()
    {
        $this->expectException(IllegalArgumentException::class);
        $this->expectExceptionCode(31);
        $this->expectExceptionMessageRegExp('/Invalid multipart\/form-data/');
        new RawFormDataContent($this->contentType, $this->rawDataZipFile);
    }

    public function testInvalidNumericBody()
    {
        $this->expectException(IllegalArgumentException::class);
        new RawFormDataContent($this->contentType, 123);
    }

}