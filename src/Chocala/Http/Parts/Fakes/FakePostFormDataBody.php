<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\PostFormDataBody;

class FakePostFormDataBody extends PostFormDataBody
{

    public function __construct()
    {
        $_POST = FakeFormDataBody::ARRAY_DATA;
        parent::__construct();
    }

}