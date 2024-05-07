<?php

namespace Chocala\Http\Request\Parts\Fakes;

use Chocala\Http\Request\Parts\MessageBodyInterface;
use Chocala\Http\Request\Parts\TextHtmlBody;

class FakeTextHtmlBody extends TextHtmlBody implements MessageBodyInterface
{
    public const DEFAULT_DATA = '<h1>Title</h1><p>You got your HTML content for your test...</p>';

    public function __construct()
    {
        parent::__construct(
            self::DEFAULT_DATA
        );
    }
}
