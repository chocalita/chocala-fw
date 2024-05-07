<?php

namespace Chocala\System\IO;

interface FileInterface
{
    public function path(): string;

    public function exists(): bool;

    public function isDirectory(): bool;

    public function read(): string;

    public function write(string $content): bool;

    public function delete(): bool;

    public function directory(): string;

    public function parent(): FileInterface;

    public function mkdir(): bool;

    public function mkdirs(): bool;

    public function properties(): FileProperties;
}
