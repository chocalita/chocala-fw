<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\RequestDataNoBody;

class FakeRequestDataNoBody extends RequestDataNoBody
{

    public function __construct()
    {
        parent::__construct(new FakeQueryParams());
    }

}