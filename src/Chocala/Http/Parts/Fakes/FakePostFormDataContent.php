<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\PostFormDataContent;

class FakePostFormDataContent extends PostFormDataContent
{

    public function __construct()
    {
        $_POST = FakeFormDataContent::ARRAY_DATA;
        parent::__construct();
    }

}