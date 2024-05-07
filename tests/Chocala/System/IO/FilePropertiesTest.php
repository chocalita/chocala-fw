<?php

namespace Chocala\System\IO;

use PHPUnit\Framework\TestCase;

class FilePropertiesTest extends TestCase
{
    /**
     * @var string
     */
    private $resourcesDir;

    /**
     * @var FileProperties
     */
    private $directoryProperties;

    /**
     * @var FileProperties
     */
    private $fileProperties;

    /**
     * @var FileProperties
     */
    private $nonDirectoryProperties;

    /**
     * @var FileProperties
     */
    private $nonFileProperties;

    public function setUp()
    {
        $this->resourcesDir = __DIR__ . DIRECTORY_SEPARATOR . 'resources';
        $directoryPath = $this->resourcesDir;
        $filePath = $directoryPath . DIRECTORY_SEPARATOR . 'FileTest.txt';
        $nonDirectoryPath = $this->resourcesDir . DIRECTORY_SEPARATOR . 'R3sPhi2uk7ov6zWq4xFv-PROPERTIES';
        $nonFilePath = $this->resourcesDir . DIRECTORY_SEPARATOR . 'R3sPhi2uk7ov6zWq4xFv-PROPERTIES.txt';
        $this->directoryProperties = new FileProperties($directoryPath);
        $this->fileProperties = new FileProperties($filePath);
        $this->nonDirectoryProperties = new FileProperties($nonDirectoryPath);
        $this->nonFileProperties = new FileProperties($nonFilePath);
    }

    public function test__construct()
    {
        $directoryPath = $this->resourcesDir . DIRECTORY_SEPARATOR . 'oneDir';
        $filePath = $directoryPath . DIRECTORY_SEPARATOR . 'oneFile.txt';
        $this->directoryProperties = new FileProperties($directoryPath);
        $this->fileProperties = new FileProperties($filePath);

        $this->expectException(\ArgumentCountError::class);
        new FileProperties();
    }

    public function testIsReadable()
    {
        $isReadableDir = $this->directoryProperties->isReadable();
        $isReadableFile = $this->fileProperties->isReadable();
        self::assertNotNull($isReadableDir);
        self::assertNotNull($isReadableFile);
        self::assertIsBool($isReadableDir);
        self::assertIsBool($isReadableFile);
        self::assertTrue($isReadableDir);
        self::assertTrue($isReadableFile);

        $isReadableNonDir = $this->nonDirectoryProperties->isReadable();
        $isReadableNonFile = $this->nonFileProperties->isReadable();
        self::assertNotNull($isReadableNonDir);
        self::assertNotNull($isReadableNonFile);
        self::assertIsBool($isReadableNonDir);
        self::assertIsBool($isReadableNonFile);
        self::assertFalse($isReadableNonDir);
        self::assertFalse($isReadableNonFile);
    }

    public function testIsWriteable()
    {
        $isWriteableDir = $this->directoryProperties->isWriteable();
        $isWriteableFile = $this->fileProperties->isWriteable();
        self::assertNotNull($isWriteableDir);
        self::assertNotNull($isWriteableFile);
        self::assertIsBool($isWriteableDir);
        self::assertIsBool($isWriteableFile);
        self::assertTrue($isWriteableDir);
        self::assertTrue($isWriteableFile);

        $isWriteableNonDir = $this->nonDirectoryProperties->isWriteable();
        $isWriteableNonFile = $this->nonFileProperties->isWriteable();
        self::assertNotNull($isWriteableNonDir);
        self::assertNotNull($isWriteableNonFile);
        self::assertIsBool($isWriteableNonDir);
        self::assertIsBool($isWriteableNonFile);
        self::assertFalse($isWriteableNonDir);
        self::assertFalse($isWriteableNonFile);
    }

    public function testIsExecutable()
    {
        $isExecutableDir = $this->directoryProperties->isExecutable();
        $isExecutableFile = $this->fileProperties->isExecutable();
        self::assertNotNull($isExecutableDir);
        self::assertNotNull($isExecutableFile);
        self::assertIsBool($isExecutableDir);
        self::assertIsBool($isExecutableFile);
        self::assertFalse($isExecutableDir);
        self::assertFalse($isExecutableFile);

        $isExecutableNonDir = $this->nonDirectoryProperties->isExecutable();
        $isExecutableNonFile = $this->nonFileProperties->isExecutable();
        self::assertNotNull($isExecutableNonDir);
        self::assertNotNull($isExecutableNonFile);
        self::assertIsBool($isExecutableNonDir);
        self::assertIsBool($isExecutableNonFile);
        self::assertFalse($isExecutableNonDir);
        self::assertFalse($isExecutableNonFile);

        //TODO: test executable files (+x)
    }

    public function testSize()
    {
        $dirSize = $this->directoryProperties->size();
        $fileSize = $this->fileProperties->size();
        $dirNonSize = $this->nonDirectoryProperties->size();
        $fileNonSize = $this->nonFileProperties->size();

        self::assertNotNull($dirSize);
        self::assertNotNull($fileSize);
        self::assertNotNull($dirNonSize);
        self::assertNotNull($fileNonSize);
        self::assertIsInt($dirSize);
        self::assertIsInt($fileSize);
        self::assertIsInt($dirNonSize);
        self::assertIsInt($fileNonSize);
        self::assertGreaterThan(0, $dirSize);
        self::assertGreaterThan(0, $fileSize);
        self::assertEquals(0, $dirNonSize);
        self::assertEquals(0, $fileNonSize);
    }
}
