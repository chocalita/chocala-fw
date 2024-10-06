<?php

namespace Chocala\Http\Control\Fakes;

use Chocala\Http\Control\Dispatch;
use Chocala\Http\Fakes\FakeRequest;
use Chocala\Http\Mapping\ActionMappingInterface;
use Chocala\Http\RequestInterface;
use Chocala\Http\ResponseInterface;
use Chocala\Http\Route\Fakes\FakeActionMapping;
use Chocala\Http\ServerInterface;

class FakeDispatch implements ServerInterface
{

    private ServerInterface $dispatch;

    public function __construct(?RequestInterface $request = null,
                                ?ActionMappingInterface $actionMapping = null
    )
    {
        $this->dispatch = new Dispatch(
            $request?: new FakeRequest(),
            $actionMapping?: new FakeActionMapping()
        );
    }

    public function submit(): ResponseInterface
    {
        return $this->dispatch->submit();
    }
}
