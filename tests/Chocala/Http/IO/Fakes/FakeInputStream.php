<?php

namespace Chocala\Http\IO\Fakes;

use Chocala\Http\IO\InputStream;
use Chocala\Http\IO\InputStreamInterface;

class FakeInputStream extends InputStream implements InputStreamInterface
{
    public function __construct($content)
    {
        parent::__construct($content);
    }
}
