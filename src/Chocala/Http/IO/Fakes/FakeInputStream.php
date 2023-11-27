<?php

namespace Chocala\Http\IO\Fakes;

use Chocala\Http\IO\InputStream;
use Chocala\Http\IO\InputStreamInterface;

class FakeInputStream implements InputStreamInterface
{

    private InputStream $inputStream;


    public function __construct($content)
    {
        $this->inputStream = new InputStream($content);
    }

    /**
     * @inheritDoc
     */
    public function content(): string
    {
        return $this->inputStream->content();
    }

}