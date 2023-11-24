<?php

namespace Chocala\Http;

interface ServerInterface
{

    public function submit(RequestInterface $request): ResponseInterface;

}
