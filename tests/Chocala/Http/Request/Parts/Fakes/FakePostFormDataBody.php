<?php

namespace Chocala\Http\Request\Parts\Fakes;

use Chocala\Http\Request\Parts\MessageBodyInterface;
use Chocala\Http\Request\Parts\PostFormDataBody;

class FakePostFormDataBody extends PostFormDataBody implements MessageBodyInterface
{
    public function __construct()
    {
        $_POST = FakeFormDataBody::ARRAY_DATA;
        parent::__construct();
    }
}
