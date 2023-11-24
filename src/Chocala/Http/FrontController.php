<?php

namespace Chocala\Http\Control;

use Chocala\Http\ServerInterface;
use Chocala\System\HttpManagement;

class FrontController implements HttpManagement
{

    /**
     * @var ServerInterface
     */
    private $server;

    public function __construct(ServerInterface $server)
    {
        $this->server = $server;
    }

    public function route()
    {
        // TODO: Implement route() method.
        $this->server->submit(null);
    }

}
