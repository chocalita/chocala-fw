<?php

namespace Chocala\Http\Request\Parts\Fakes;

use Chocala\Http\Request\Parts\RequestDataInterface;
use Chocala\Http\Request\Parts\RequestDataNoBody;

class FakeRequestDataNoBody extends RequestDataNoBody implements RequestDataInterface
{
    public function __construct()
    {
        parent::__construct(new FakeQueryParams());
    }
}
