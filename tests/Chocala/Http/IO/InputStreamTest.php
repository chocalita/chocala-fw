<?php

namespace Chocala\Http\IO;

use Chocala\Http\IO\Fakes\FakeInputStream;
use PHPUnit\Framework\TestCase;

class InputStreamTest extends TestCase
{

    private const FAKE_CONTENT = 'fake content';

    private FakeInputStream $fakeInputStream;

    public function setUp()
    {
        $this->fakeInputStream = new FakeInputStream(self::FAKE_CONTENT);
    }

    public function test__construct()
    {
        $inputStream = new InputStream();
        self::assertIsObject($inputStream);
        $inputStream = new InputStream('content');
        self::assertIsObject($inputStream);
        $this->expectException(\InvalidArgumentException::class);
        new InputStream('content', '');
        $this->expectException(\InvalidArgumentException::class);
        new InputStream(null);
        $this->expectException(\InvalidArgumentException::class);
        new InputStream(0);
    }

    public function testContent()
    {
        $inputStream = new InputStream();
        self::assertIsObject($inputStream);
        self::assertObjectHasAttribute('content', $inputStream);
        self::assertIsString($inputStream->content());
        self::assertEquals('', $inputStream->content());
        self::assertNotSame(null, $inputStream->content());

        $customContent = 'Forced custom content';
        $inputStream = new InputStream($customContent);
        self::assertIsObject($inputStream);
        self::assertObjectHasAttribute('content', $inputStream);
        self::assertIsString($inputStream->content());
        self::assertEquals($customContent, $inputStream->content());
    }

}
