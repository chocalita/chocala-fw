<?php

namespace Chocala\Http\Control;

use Chocala\Http\HttpManagement;
use Chocala\Http\ServerInterface;

class FrontController implements HttpManagement
{
    /**
     * @var ServerInterface
     */
    private ServerInterface $server;

    public function __construct(ServerInterface $server)
    {
        $this->server = $server;
    }

    public function route()
    {
        // TODO: Implement route() method.
        $response = $this->server->submit();

        foreach ($response->headers()->headerList() as $hKey => $hValue) {
            \HttpResponse::setHeader($hKey, $hValue);
        }
        // TODO: apply cache info headers
        // TODO: set http status

        echo $response->body()->data();

    }
}
