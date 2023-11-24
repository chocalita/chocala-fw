<?php

namespace Chocala\Http\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class TextHtmlBodyTest extends TestCase
{

    public function test__construct()
    {
        $textHtmlBody = new TextHtmlBody(null);
        self::assertIsObject($textHtmlBody);
        $textHtmlBody = new TextHtmlBody('');
        self::assertIsObject($textHtmlBody);
        self::assertIsObject($textHtmlBody);
        $textHtmlBody = new TextHtmlBody('<h1>54</h1>');
        self::assertIsObject($textHtmlBody);
        $textHtmlBody = new TextHtmlBody('<html><head>Header part 8</head><body>Body part</body></html>');
        self::assertIsObject($textHtmlBody);
        $this->expectException(IllegalArgumentException::class);
        new TextHtmlBody('simpleWord');
    }

    public function testType()
    {
        $textHtmlBody = new TextHtmlBody(null);
        self::assertIsObject($textHtmlBody);
        self::assertEquals(ContentType::TEXT_HTML, $textHtmlBody->type());
        $textHtmlBody = new TextHtmlBody(' ');
        self::assertIsObject($textHtmlBody);
        self::assertEquals(ContentType::TEXT_HTML, $textHtmlBody->type());
        $textHtmlBody = new TextHtmlBody('<html><head>Header part 8</head><body>Body part</body></html>');
        self::assertIsObject($textHtmlBody);
        self::assertEquals(ContentType::TEXT_HTML, $textHtmlBody->type());
    }

    public function testBody()
    {
        $body = ' ';
        $textHtmlBody = new TextHtmlBody($body);
        self::assertNotNull($textHtmlBody->body());
        self::assertEmpty($textHtmlBody->body());
        self::assertIsString($textHtmlBody->body());

        $body = ' <h2>not empty</h2>';
        $textHtmlBody = new TextHtmlBody($body);
        self::assertNotNull($textHtmlBody->body());
        self::assertNotEmpty($textHtmlBody->body());
        self::assertIsString($textHtmlBody->body());
        self::assertEquals('<h2>not empty</h2>', $textHtmlBody->body());

        $body = '  <html><head>Header part <p>Paragraph</p></head><body>Body part</body></html>  ';
        $textHtmlBody = new TextHtmlBody($body);
        self::assertNotNull($textHtmlBody->body());
        self::assertNotEmpty($textHtmlBody->body());
        self::assertIsString($textHtmlBody->body());
        self::assertStringStartsWith('<html>', $textHtmlBody->body());
        self::assertStringStartsNotWith(' <html>', $textHtmlBody->body());
        self::assertStringEndsWith('</html>', $textHtmlBody->body());
        self::assertStringEndsNotWith('</html> ', $textHtmlBody->body());
        self::assertStringContainsString('<head>', $textHtmlBody->body());
        self::assertStringContainsString('<p>', $textHtmlBody->body());
        self::assertStringContainsString('<body>', $textHtmlBody->body());
        self::assertStringContainsString('Header part ', $textHtmlBody->body());
        self::assertStringContainsString('Paragraph', $textHtmlBody->body());
        self::assertStringContainsString('Body part', $textHtmlBody->body());
        self::assertStringNotContainsString('Body part ', $textHtmlBody->body());

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
