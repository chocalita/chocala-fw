<?php
/**
 * User: Yecid
 * Date: 7/1/2020
 * Time: 23:44
 */

namespace Chocala\Http;

use ChocalaException;
use Psr\Http\Message\ServerRequestInterface;

class HttpException extends ChocalaException
{

    public function __construct($message, $code = 0, Throwable $previous = null
//        ServerRequestInterface $request,
    ) {
        parent::__construct($message, $code, $previous);
//        $this->request = $request;
    }

}