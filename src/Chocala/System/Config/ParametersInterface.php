<?php

namespace Chocala\System\Config;

use Chocala\System\IO\File;

interface ParametersInterface
{
    public function load(File $file);

    public function list(): array;

    public function param($name): Parameter;

    public function value($name);
}
