<?php

namespace Chocala\Http\Response\Parts;

interface StatusCodeInterface
{

    public function code() : int;

    public function message() : string;

}