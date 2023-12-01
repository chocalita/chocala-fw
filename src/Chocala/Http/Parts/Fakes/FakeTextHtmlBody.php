<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\TextHtmlBody;

class FakeTextHtmlBody extends TextHtmlBody
{
    public const DEFAULT_DATA = '<h1>Title</h1><p>You got your HTML content for your test...</p>';

    public function __construct()
    {
        parent::__construct(self::DEFAULT_DATA);
    }

}