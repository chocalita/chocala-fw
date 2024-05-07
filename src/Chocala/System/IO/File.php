<?php

namespace Chocala\System\IO;

class File implements FileInterface
{
    /**
     * @var string
     */
    private $filePath;

    /**
     * @var FileProperties
     */
    private $fileProperties;

    /**
     * File constructor.
     * @param string $filePath
     */
    public function __construct(string $filePath)
    {
        $this->filePath = str_replace(
            '\\',
            DIRECTORY_SEPARATOR,
            str_replace('/', DIRECTORY_SEPARATOR, $filePath)
        );
        $this->fileProperties = new FileProperties($filePath);
    }

    public function path(): string
    {
        return $this->filePath;
    }

    public function exists(): bool
    {
        return file_exists($this->filePath);
    }

    public function isDirectory(): bool
    {
        return is_dir($this->filePath) ?:
            (is_file($this->filePath) ? false : is_bool(strpos(basename($this->filePath), '.')));
    }

    public function read(): string
    {
        if (!$this->exists()) {
            throw new IOException(sprintf('Unable to open file \'%s\'', $this->filePath));
        }
        return file_get_contents($this->filePath);
    }

    public function write(string $content): bool
    {
        // TODO: check directory permissions
        return file_put_contents($this->filePath, $content);
    }

    public function delete(): bool
    {
        // TODO: check file permissions
        if (!$this->exists()) {
            throw new IOException(sprintf('File or Directory \'%s\' not found', $this->filePath));
        }
        if ($this->isDirectory() && !rmdir($this->filePath)) {
            throw new IOException(sprintf('Directory \'%s\' can\'t be deleted', $this->filePath));
        } elseif (!$this->isDirectory() && !unlink($this->filePath)) {
            throw new IOException(sprintf('File \'%s\' can\'t be deleted', $this->filePath));
        }
        return true;
    }

    public function directory(): string
    {
        $dirObject = $this;
        if (!$this->isDirectory()) {
            $dirObject = $this->parent();
        }
        return $dirObject->path();
    }

    public function parent(): FileInterface
    {
        return new File(dirname($this->filePath));
    }

    public function mkdir(): bool
    {
        $directory = new File($this->directory());
        if ($directory->exists()) {
            throw new IOException(sprintf('Directory \'%s\' exists', $directory->path()));
        }
        return @mkdir($directory->path(), 0777, false);
    }

    public function mkdirs(): bool
    {
        $directory = new File($this->directory());
        if ($directory->exists()) {
            throw new IOException(sprintf('Directory \'%s\' exists', $directory->path()));
        }
        return @mkdir($directory->path(), 0777, true);
    }

    public function properties(): FileProperties
    {
        return $this->fileProperties;
    }
}
