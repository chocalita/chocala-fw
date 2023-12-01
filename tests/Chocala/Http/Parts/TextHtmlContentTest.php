<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class TextHtmlContentTest extends TestCase
{

    public function test__construct()
    {
        $textHtmlContent = new TextHtmlBody(null);
        self::assertIsObject($textHtmlContent);
        $textHtmlContent = new TextHtmlBody('');
        self::assertIsObject($textHtmlContent);
        self::assertIsObject($textHtmlContent);
        $textHtmlContent = new TextHtmlBody('<h1>54</h1>');
        self::assertIsObject($textHtmlContent);
        $textHtmlContent = new TextHtmlBody('<html><head>Header part 8</head><body>Body part</body></html>');
        self::assertIsObject($textHtmlContent);
        $this->expectException(IllegalArgumentException::class);
        new TextHtmlBody('simpleWord');
    }

    public function testType()
    {
        $textHtmlContent = new TextHtmlBody(null);
        self::assertIsObject($textHtmlContent);
        self::assertEquals(ContentType::TEXT_HTML, $textHtmlContent->type());
        $textHtmlContent = new TextHtmlBody(' ');
        self::assertIsObject($textHtmlContent);
        self::assertEquals(ContentType::TEXT_HTML, $textHtmlContent->type());
        $textHtmlContent = new TextHtmlBody('<html><head>Header part 8</head><body>Body part</body></html>');
        self::assertIsObject($textHtmlContent);
        self::assertEquals(ContentType::TEXT_HTML, $textHtmlContent->type());
    }

    public function testData()
    {
        $body = ' ';
        $textHtmlContent = new TextHtmlBody($body);
        self::assertNotNull($textHtmlContent->data());
        self::assertEmpty($textHtmlContent->data());
        self::assertIsString($textHtmlContent->data());

        $body = ' <h2>not empty</h2>';
        $textHtmlContent = new TextHtmlBody($body);
        self::assertNotNull($textHtmlContent->data());
        self::assertNotEmpty($textHtmlContent->data());
        self::assertIsString($textHtmlContent->data());
        self::assertEquals('<h2>not empty</h2>', $textHtmlContent->data());

        $body = '  <html><head>Header part <p>Paragraph</p></head><body>Body part</body></html>  ';
        $textHtmlContent = new TextHtmlBody($body);
        self::assertNotNull($textHtmlContent->data());
        self::assertNotEmpty($textHtmlContent->data());
        self::assertIsString($textHtmlContent->data());
        self::assertStringStartsWith('<html>', $textHtmlContent->data());
        self::assertStringStartsNotWith(' <html>', $textHtmlContent->data());
        self::assertStringEndsWith('</html>', $textHtmlContent->data());
        self::assertStringEndsNotWith('</html> ', $textHtmlContent->data());
        self::assertStringContainsString('<head>', $textHtmlContent->data());
        self::assertStringContainsString('<p>', $textHtmlContent->data());
        self::assertStringContainsString('<body>', $textHtmlContent->data());
        self::assertStringContainsString('Header part ', $textHtmlContent->data());
        self::assertStringContainsString('Paragraph', $textHtmlContent->data());
        self::assertStringContainsString('Body part', $textHtmlContent->data());
        self::assertStringNotContainsString('Body part ', $textHtmlContent->data());

        $body = '{}';
        $this->expectException(IllegalArgumentException::class);
        new TextHtmlBody($body);
    }

    public function testNumericBody()
    {
        $this->expectException(IllegalArgumentException::class);
        new TextHtmlBody(123);
    }

    public function testInvalidBody()
    {
        $this->expectException(IllegalArgumentException::class);
        new TextHtmlBody(' </> ');
    }

}
