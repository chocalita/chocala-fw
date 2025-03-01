<?php

namespace App\Controllers\section;

use Chocala\Http\Response\Exceptions\HttpNotAcceptableException;
use Chocala\Http\Response\Exceptions\HttpServerErrorException;
use Chocala\Web\ControllerBase;

class TestController extends ControllerBase
{
    public function dummy406()
    {
        throw new HttpNotAcceptableException('Not Acceptable (custom response)');
    }

    public function dummy500()
    {
        throw new HttpServerErrorException('Server Error (custom response)');
    }
}
