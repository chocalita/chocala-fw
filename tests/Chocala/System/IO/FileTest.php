<?php

namespace Chocala\System\IO;

use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    /**
     * @var string
     */
    private $resourcesDir;

    /**
     * @var File
     */
    private $baseDirectory;

    /**
     * @var File
     */
    private $baseFile;

    /**
     * @var File
     */
    private $newFile;

    /**
     * @var false|string
     */
    private $baseContent;

    public function setUp()
    {
        $this->resourcesDir = __DIR__ . DIRECTORY_SEPARATOR . 'resources';
        $baseDirectoryPath = $this->resourcesDir;
        $baseFilePath = $baseDirectoryPath . DIRECTORY_SEPARATOR . 'FileTest.txt';
        $newFilePath = $baseDirectoryPath . DIRECTORY_SEPARATOR . 'testFile.txt';
        $this->baseDirectory = new File($baseDirectoryPath);
        $this->baseFile = new File($baseFilePath);
        $this->newFile = new File($newFilePath);
        $this->baseContent = file_get_contents($baseFilePath);
    }

    public function test__construct()
    {
        $directoryPath = $this->resourcesDir . DIRECTORY_SEPARATOR . 'oneDir';
        $filePath = $directoryPath . DIRECTORY_SEPARATOR . 'oneFile.txt';
        $directory = new File($filePath);
        $file = new File($filePath);
        self::assertNotNull($directory);
        self::assertNotNull($file);
        self::assertIsObject($directory);
        self::assertIsObject($file);
    }

    public function testPath()
    {
        self::assertNotNull($this->baseDirectory->path());
        self::assertNotNull($this->baseFile->path());
        self::assertNotNull($this->newFile->path());

        self::assertIsString($this->baseDirectory->path());
        self::assertIsString($this->baseFile->path());
        self::assertIsString($this->newFile->path());

        self::assertStringEndsWith(DIRECTORY_SEPARATOR . 'resources', $this->baseDirectory->path());
        self::assertStringEndsWith(DIRECTORY_SEPARATOR . 'FileTest.txt', $this->baseFile->path());
        self::assertStringEndsWith(DIRECTORY_SEPARATOR . 'testFile.txt', $this->newFile->path());

        $badDirectorySeparator = DIRECTORY_SEPARATOR === '/' ? '\\' : '/';

        self::assertStringNotContainsString($badDirectorySeparator, $this->baseDirectory->path());
        self::assertStringNotContainsString($badDirectorySeparator, $this->baseFile->path());
        self::assertStringNotContainsString($badDirectorySeparator, $this->newFile->path());
    }

    public function testExists()
    {
        $existingDir = $this->baseDirectory;
        $existingFile = $this->baseFile;
        $notExistingDir = new File($this->resourcesDir . DIRECTORY_SEPARATOR . 'R3sPhi2uk7ov6zWq4xFv-EXISTS');
        $notExistingFile = new File($this->resourcesDir . DIRECTORY_SEPARATOR . 'R3sPhi2uk7ov6zWq4xFv-EXISTS.txt');

        self::assertNotNull($existingDir->exists());
        self::assertNotNull($existingFile->exists());
        self::assertNotNull($notExistingDir->exists());
        self::assertNotNull($notExistingFile->exists());

        self::assertIsBool($existingDir->exists());
        self::assertIsBool($existingFile->exists());
        self::assertIsBool($notExistingDir->exists());
        self::assertIsBool($notExistingFile->exists());

        self::assertEquals(true, $existingDir->exists());
        self::assertEquals(true, $existingFile->exists());
        self::assertEquals(false, $notExistingDir->exists());
        self::assertEquals(false, $notExistingFile->exists());
    }

    public function testIsDirectory()
    {
        $existingDir = $this->baseDirectory;
        $existingFile = $this->baseFile;
        $notExistingDir = new File($this->resourcesDir . DIRECTORY_SEPARATOR . 'R3sPhi2uk7ov6zWq4xFv-ISDIRECTORY');
        $notExistingFile = new File($this->resourcesDir . DIRECTORY_SEPARATOR . 'R3sPhi2uk7ov6zWq4xFv-ISDIRECTORY.txt');

        self::assertNotNull($existingDir->isDirectory());
        self::assertNotNull($existingFile->isDirectory());
        self::assertNotNull($notExistingDir->isDirectory());
        self::assertNotNull($notExistingFile->isDirectory());

        self::assertIsBool($existingDir->isDirectory());
        self::assertIsBool($existingFile->isDirectory());
        self::assertIsBool($notExistingDir->isDirectory());
        self::assertIsBool($notExistingFile->isDirectory());

        self::assertEquals(true, $existingDir->isDirectory());
        self::assertEquals(false, $existingFile->isDirectory());
        self::assertEquals(true, $notExistingDir->isDirectory());
        self::assertEquals(false, $notExistingFile->isDirectory());
    }

    public function testRead()
    {
        self::assertNotNull($this->baseFile->read());
        self::assertIsString($this->baseFile->read());
        self::assertEquals($this->baseContent, $this->baseFile->read());

        $notExistingFile = new File($this->resourcesDir . DIRECTORY_SEPARATOR . 'R3sPhi2uk7ov6zWq4xFv-READ.txt');
        $this->expectException(IOException::class);
        $notExistingFile->read();
        //TODO: permissions case
    }

    public function testWrite()
    {
        $writed = $this->newFile->write($this->baseContent);
        self::assertNotNull($writed);
        self::assertIsBool($writed);
        self::assertEquals(true, $writed);

        //TODO: permissions case
//        $this->expectException(IOException::class);
    }

    public function testReadWrite()
    {
        $this->newFile->write('');
        $readFile = $this->newFile->read();
        self::assertNotNull($readFile);
        self::assertIsString($readFile);
        self::assertEmpty($readFile);
        self::assertNotEquals('XYZ', $readFile);

        $writeFile = $this->newFile->write($this->baseContent);
        self::assertNotNull($writeFile);
        self::assertIsBool($writeFile);
        self::assertEquals($this->baseContent, $this->newFile->read());

        $newContent = 'LOREN IPSUM';
        $this->newFile->write($newContent);
        self::assertEquals($newContent, $this->newFile->read());

        $deleteFile = $this->newFile->delete();
        self::assertNotNull($deleteFile);
        self::assertIsBool($deleteFile);
        self::assertEquals(true, $deleteFile);

        $this->expectException(IOException::class);
        $this->newFile->read();
    }

    public function testDelete()
    {
        $this->newFile->write('');
        $deleteFile = $this->newFile->delete();
        self::assertNotNull($deleteFile);
        self::assertIsBool($deleteFile);
        self::assertEquals(true, $deleteFile);

        $this->expectException(IOException::class);
        $this->newFile->delete();
    }

    public function testDeleteDirectory()
    {
        $deletePath = $this->resourcesDir . DIRECTORY_SEPARATOR . 'testDelete';
        mkdir($deletePath);
        $tempDir = new File($deletePath);
        $deleteDirectory = $tempDir->delete();
        self::assertNotNull($deleteDirectory);
        self::assertIsBool($deleteDirectory);
        self::assertEquals(true, $deleteDirectory);

        $this->expectException(IOException::class);
        $tempDir->delete();
    }

    public function testDirectory()
    {
        $dirDirectory = $this->baseDirectory->directory();
        $fileDirectory = $this->baseFile->directory();

        self::assertNotNull($dirDirectory);
        self::assertNotNull($fileDirectory);
        self::assertIsString($dirDirectory);
        self::assertIsString($fileDirectory);
        self::assertEquals($this->resourcesDir, $dirDirectory);
        self::assertEquals($this->resourcesDir, $fileDirectory);
    }

    public function testParent()
    {
        $dirParent = $this->baseDirectory->parent();
        $fileParent = $this->baseFile->parent();

        self::assertNotNull($dirParent);
        self::assertNotNull($fileParent);
        self::assertIsObject($dirParent);
        self::assertIsObject($fileParent);
        self::assertNotEquals($this->baseDirectory, $dirParent);
        self::assertNotEquals($this->baseFile, $fileParent);
        self::assertEquals(dirname($this->resourcesDir), $dirParent->path());
        self::assertEquals($this->resourcesDir, $fileParent->path());
    }

    public function testMkdir()
    {
        $tempDir = $this->resourcesDir . DIRECTORY_SEPARATOR . 'tempMkdir';
        mkdir($tempDir);
        $dirTest = new File($tempDir . DIRECTORY_SEPARATOR . 'dirTest');
        $fileTest = new File($tempDir . DIRECTORY_SEPARATOR . 'fileTest' . DIRECTORY_SEPARATOR . 'test.txt');
        $dirMkdir = $dirTest->mkdir();
        $fileMkdir = $fileTest->mkdir();

        self::assertNotNull($dirMkdir);
        self::assertNotNull($fileMkdir);
        self::assertIsBool($dirMkdir);
        self::assertIsBool($fileMkdir);
        self::assertEquals(true, $dirMkdir);
        self::assertEquals(true, $fileMkdir);

        $dirTest->delete();
        $fileTest->parent()->delete();
        rmdir($tempDir);

        $this->expectException(IOException::class);
        $this->baseDirectory->mkdir();
    }

    public function testMkdirs()
    {
        $tempDir = $this->resourcesDir . DIRECTORY_SEPARATOR . 'tempMkdirs';
        mkdir($tempDir);
        $dirsDirectory = ['d1', 'd2', 'd3', 'dirTest'];
        $dirsFile = ['f1', 'f2', 'f3', 'fileTest'];
        $dirTest = new File($tempDir . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $dirsDirectory));
        $fileTest = new File(
            $tempDir . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $dirsFile) .
            DIRECTORY_SEPARATOR . 'test.txt'
        );
        $dirMkdir = $dirTest->mkdirs();
        $fileMkdir = $fileTest->mkdirs();

        self::assertNotNull($dirMkdir);
        self::assertNotNull($fileMkdir);
        self::assertIsBool($dirMkdir);
        self::assertIsBool($fileMkdir);
        self::assertEquals(true, $dirMkdir);
        self::assertEquals(true, $fileMkdir);

        $dirTest->delete();
        $fileTest->parent()->delete();

        $this->removeTree($tempDir);

        $this->expectException(IOException::class);
        $this->baseDirectory->mkdirs();
    }

    public function testProperties()
    {
        $dirProperties = $this->baseDirectory->properties();
        $fileProperties = $this->baseFile->properties();
        self::assertNotNull($dirProperties);
        self::assertNotNull($fileProperties);
        self::assertIsObject($dirProperties);
        self::assertIsObject($fileProperties);
        self::assertInstanceOf(FileProperties::class, $dirProperties);
        self::assertInstanceOf(FileProperties::class, $fileProperties);
    }

    private function removeTree($dir)
    {
        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->removeTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }
}
