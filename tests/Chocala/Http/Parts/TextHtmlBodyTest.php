<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class TextHtmlBodyTest extends TestCase
{

    public function test__construct()
    {
        $textHtmlBody = new TextHtmlContent(null);
        self::assertIsObject($textHtmlBody);
        $textHtmlBody = new TextHtmlContent('');
        self::assertIsObject($textHtmlBody);
        self::assertIsObject($textHtmlBody);
        $textHtmlBody = new TextHtmlContent('<h1>54</h1>');
        self::assertIsObject($textHtmlBody);
        $textHtmlBody = new TextHtmlContent('<html><head>Header part 8</head><body>Body part</body></html>');
        self::assertIsObject($textHtmlBody);
        $this->expectException(IllegalArgumentException::class);
        new TextHtmlContent('simpleWord');
    }

    public function testType()
    {
        $textHtmlBody = new TextHtmlContent(null);
        self::assertIsObject($textHtmlBody);
        self::assertEquals(ContentType::TEXT_HTML, $textHtmlBody->type());
        $textHtmlBody = new TextHtmlContent(' ');
        self::assertIsObject($textHtmlBody);
        self::assertEquals(ContentType::TEXT_HTML, $textHtmlBody->type());
        $textHtmlBody = new TextHtmlContent('<html><head>Header part 8</head><body>Body part</body></html>');
        self::assertIsObject($textHtmlBody);
        self::assertEquals(ContentType::TEXT_HTML, $textHtmlBody->type());
    }

    public function testBody()
    {
        $body = ' ';
        $textHtmlBody = new TextHtmlContent($body);
        self::assertNotNull($textHtmlBody->data());
        self::assertEmpty($textHtmlBody->data());
        self::assertIsString($textHtmlBody->data());

        $body = ' <h2>not empty</h2>';
        $textHtmlBody = new TextHtmlContent($body);
        self::assertNotNull($textHtmlBody->data());
        self::assertNotEmpty($textHtmlBody->data());
        self::assertIsString($textHtmlBody->data());
        self::assertEquals('<h2>not empty</h2>', $textHtmlBody->data());

        $body = '  <html><head>Header part <p>Paragraph</p></head><body>Body part</body></html>  ';
        $textHtmlBody = new TextHtmlContent($body);
        self::assertNotNull($textHtmlBody->data());
        self::assertNotEmpty($textHtmlBody->data());
        self::assertIsString($textHtmlBody->data());
        self::assertStringStartsWith('<html>', $textHtmlBody->data());
        self::assertStringStartsNotWith(' <html>', $textHtmlBody->data());
        self::assertStringEndsWith('</html>', $textHtmlBody->data());
        self::assertStringEndsNotWith('</html> ', $textHtmlBody->data());
        self::assertStringContainsString('<head>', $textHtmlBody->data());
        self::assertStringContainsString('<p>', $textHtmlBody->data());
        self::assertStringContainsString('<body>', $textHtmlBody->data());
        self::assertStringContainsString('Header part ', $textHtmlBody->data());
        self::assertStringContainsString('Paragraph', $textHtmlBody->data());
        self::assertStringContainsString('Body part', $textHtmlBody->data());
        self::assertStringNotContainsString('Body part ', $textHtmlBody->data());

        $body = '{}';
        $this->expectException(IllegalArgumentException::class);
        new TextHtmlContent($body);
    }

    public function testNumericBody()
    {
        $this->expectException(IllegalArgumentException::class);
        new TextHtmlContent(123);
    }

    public function testInvalidBody()
    {
        $this->expectException(IllegalArgumentException::class);
        new TextHtmlContent(' </> ');
    }

}
