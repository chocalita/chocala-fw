<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\PostFormDataBody;

class FakePostFormDataContent extends PostFormDataBody
{

    public function __construct()
    {
        $_POST = FakeFormDataContent::ARRAY_DATA;
        parent::__construct();
    }

}