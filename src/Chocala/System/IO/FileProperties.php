<?php

namespace Chocala\System\IO;

class FileProperties
{
    /**
     * @var string
     */
    private $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @return bool
     */
    public function isReadable(): bool
    {
        return file_exists($this->filePath) && is_readable($this->filePath);
    }

    /**
     * @return bool
     */
    public function isWriteable(): bool
    {
        return file_exists($this->filePath) && is_writeable($this->filePath);
    }

    /**
     * @return bool
     */
    public function isExecutable(): bool
    {
        return file_exists($this->filePath) && is_executable($this->filePath);
    }

    /**
     * @return int
     */
    public function size(): int
    {
        if (!file_exists($this->filePath)) {
            return 0;
        }
        if (is_dir($this->filePath)) {
            $totalSize = 0;
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->filePath));
            foreach ($files as $file) {
                $totalSize += $file->getSize();
            }
            return $totalSize;
        }
        if (substr(PHP_OS, 0, 3) == 'WIN') {
            // WINDOWS: The system cannot find the path specified.
            // WINDOWS: El sistema no puede encontrar la ruta especificada.
            exec('for %I in ("' . $this->filePath . '") do @echo %~zI', $output, $res);
            return $output[0];
        } else {
            return filesize($this->filePath);
        }
    }
}
