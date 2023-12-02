<?php

namespace Chocala\Http\Parts\Fakes;

use Chocala\Http\Parts\RequestDataInterface;
use Chocala\Http\Parts\RequestDataNoBody;

class FakeRequestDataNoBody extends RequestDataNoBody implements RequestDataInterface
{

    public function __construct()
    {
        parent::__construct(new FakeQueryParams());
    }

}