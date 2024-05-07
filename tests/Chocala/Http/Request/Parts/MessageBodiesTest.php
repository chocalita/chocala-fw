<?php

namespace Http\Request\Parts;

use Chocala\Base\IllegalArgumentException;
use Chocala\Base\UnsupportedOperationException;
use Chocala\Http\HttpMethod;
use Chocala\Http\IO\Fakes\FakeInputStream;
use Chocala\Http\Request\Parts\Fakes\FakeFormDataBody;
use Chocala\Http\Request\Parts\Fakes\FakeRawFormDataBody;
use Chocala\Http\Request\Parts\FormDataBody;
use Chocala\Http\Request\Parts\FormUrlencodedBody;
use Chocala\Http\Request\Parts\JsonMessageBody;
use Chocala\Http\Request\Parts\MessageBodies;
use Chocala\Http\Request\Parts\MessageBody;
use Chocala\Http\Request\Parts\MessageBodyInterface;
use Chocala\Http\Request\Parts\PostFormDataBody;
use Chocala\Http\Request\Parts\RawFormDataBody;
use Chocala\Http\Request\Parts\TextHtmlBody;
use Chocala\System\ContentType;
use PHPUnit\Framework\TestCase;

class MessageBodiesTest extends TestCase
{
    private MessageBodies $messageBodies;

    public function setUp()
    {
        $this->messageBodies = new MessageBodies();
    }

    public function test__construct()
    {
        $object = new MessageBodies();
        self::assertNotNull($object);
        self::assertIsObject($object);
        self::assertInstanceOf(MessageBodies::class, $object);

        self::assertNotNull($this->messageBodies);
        self::assertIsObject($this->messageBodies);
        self::assertInstanceOf(MessageBodies::class, $this->messageBodies);
    }

    public function testMake()
    {
        $messageBodies = new MessageBodies();
        self::assertIsObject($messageBodies);
    }

    public function testMakeFormDataBody()
    {
        $_POST = FakeFormDataBody::ARRAY_DATA;
        $formDataBody = $this->messageBodies->make(HttpMethod::POST(), ContentType::MULTIPART_FORM_DATA, new FakeInputStream(''));
        self::assertNotNull($formDataBody);
        self::assertIsObject($formDataBody);
        self::assertInstanceOf(FormDataBody::class, $formDataBody);
        self::assertInstanceOf(PostFormDataBody::class, $formDataBody);

        $contentType = FakeRawFormDataBody::contentType();
        $rawData = FakeRawFormDataBody::rawData();

        $formDataBody = $this->messageBodies->make(HttpMethod::PUT(), $contentType, new FakeInputStream($rawData));
        self::assertIsObject($formDataBody);
        self::assertNotNull($formDataBody);
        self::assertIsObject($formDataBody);
        self::assertInstanceOf(MessageBodyInterface::class, $formDataBody);
        self::assertInstanceOf(FormDataBody::class, $formDataBody);
        self::assertInstanceOf(RawFormDataBody::class, $formDataBody);

        $this->expectException(IllegalArgumentException::class);
        $this->messageBodies->make(HttpMethod::PUT(), $contentType, new FakeInputStream('some body'));
    }

    public function testMakeTextPlain()
    {
        $textHtmlBody = $this->messageBodies->make(HttpMethod::PATCH(), ContentType::TEXT_PLAIN, new FakeInputStream('<h1>54</h1>'));
        self::assertNotNull($textHtmlBody);
        self::assertIsObject($textHtmlBody);
        self::assertInstanceOf(MessageBodyInterface::class, $textHtmlBody);
        self::assertInstanceOf(MessageBody::class, $textHtmlBody);

        $this->expectException(\InvalidArgumentException::class);
        $this->messageBodies->make(HttpMethod::PATCH(), ContentType::TEXT_PLAIN, new FakeInputStream(null));
    }

    public function testMakeTextHtmlBody()
    {
        $textHtmlBody = $this->messageBodies->make(HttpMethod::PATCH(), ContentType::TEXT_HTML, new FakeInputStream('<h1>54</h1>'));
        self::assertNotNull($textHtmlBody);
        self::assertIsObject($textHtmlBody);
        self::assertInstanceOf(MessageBodyInterface::class, $textHtmlBody);
        self::assertInstanceOf(TextHtmlBody::class, $textHtmlBody);

        $this->expectException(IllegalArgumentException::class);
        $this->messageBodies->make(HttpMethod::PATCH(), ContentType::TEXT_HTML, new FakeInputStream('< NO HTML</h1>'));
    }

    public function testJsonMessageBody()
    {
        $jsonMessageBody = $this->messageBodies->make(HttpMethod::PATCH(), ContentType::APPLICATION_JSON, new FakeInputStream(''));
        self::assertNotNull($jsonMessageBody);
        self::assertIsObject($jsonMessageBody);
        self::assertInstanceOf(MessageBodyInterface::class, $jsonMessageBody);
        self::assertInstanceOf(JsonMessageBody::class, $jsonMessageBody);

        $this->expectException(IllegalArgumentException::class);
        $this->messageBodies->make(HttpMethod::PATCH(), ContentType::APPLICATION_JSON, new FakeInputStream('NO JSON'));
    }

    public function testFormUrlencodedBody($contentType = null)
    {
        if ($contentType == null) {
            $contentType = ContentType::APPLICATION_FORM_URLENCODED;
        }

        $jsonMessageBody = $this->messageBodies->make(HttpMethod::PATCH(), $contentType, new FakeInputStream(''));
        self::assertNotNull($jsonMessageBody);
        self::assertIsObject($jsonMessageBody);
        self::assertInstanceOf(MessageBodyInterface::class, $jsonMessageBody);
        self::assertInstanceOf(FormUrlencodedBody::class, $jsonMessageBody);

        $this->expectException(IllegalArgumentException::class);
        $this->messageBodies->make(HttpMethod::PATCH(), $contentType, new FakeInputStream('NO DATA'));
    }

    public function testDefaultHeader()
    {
        // testing default case without header content type, this returns and tests a FormUrlencodedBody
        $this->testFormUrlencodedBody([]);
    }

    public function testMakeXml()
    {
        $this->expectException(UnsupportedOperationException::class);
        $this->messageBodies->make(HttpMethod::PATCH(), ContentType::APPLICATION_XML, new FakeInputStream('some content'));
    }

    public function testMultipartMixed()
    {
        $this->expectException(UnsupportedOperationException::class);
        $this->messageBodies->make(HttpMethod::PATCH(), ContentType::MULTIPART_MIXED, new FakeInputStream('some content'));
    }

    public function testMultipartAlternative()
    {
        $this->expectException(UnsupportedOperationException::class);
        $this->messageBodies->make(HttpMethod::PATCH(), ContentType::MULTIPART_ALTERNATIVE, new FakeInputStream('some content'));
    }

    public function testBinary()
    {
        $this->expectException(UnsupportedOperationException::class);
        $this->messageBodies->make(HttpMethod::PATCH(), ContentType::APPLICATION_BINARY, new FakeInputStream('some content'));
    }

    public function testOctetStream()
    {
        $this->expectException(UnsupportedOperationException::class);
        $this->messageBodies->make(HttpMethod::PATCH(), ContentType::APPLICATION_OCTET_STREAM, new FakeInputStream('some content'));
    }
}
