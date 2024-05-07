<?php

namespace Chocala\System\Config;

use Chocala\System\IO\File;

interface ConfigurationsInterface
{
    public function load(File $file);

    public function list(): array;

    public function config($name): Configuration;

    public function value($name);
}
