<?php

namespace Chocala\Http\Response\Parts;

interface StatusLineInterface
{

    public function statusCode() : StatusCode;


}