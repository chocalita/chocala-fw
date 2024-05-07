<?php

namespace Chocala\Http\IO;

interface InputStreamInterface
{
    /**
     * @return string
     */
    public function content(): string;
}
