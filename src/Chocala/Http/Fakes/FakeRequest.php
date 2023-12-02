<?php

namespace Chocala\Http\Fakes;

use Chocala\Http\Parts\Fakes\FakeHeaders;
use Chocala\Http\Parts\Fakes\FakeRequestData;
use Chocala\Http\Parts\Fakes\FakeRequestLine;
use Chocala\Http\Parts\HeadersInterface;
use Chocala\Http\Parts\RequestDataInterface;
use Chocala\Http\Parts\RequestLineInterface;
use Chocala\Http\Request\Request;
use Chocala\Http\RequestInterface;

class FakeRequest extends Request implements RequestInterface
{

    public function __construct(?RequestLineInterface $fakeRequestLine = null,
                                ?HeadersInterface $fakeHeaders = null,
                                ?RequestDataInterface $fakeRequestData = null
    )
    {
        parent::__construct(
            $fakeRequestLine?: new FakeRequestLine(),
            $fakeHeaders?: new FakeHeaders(),
            $fakeRequestData?: new FakeRequestData()
        );
    }


}
