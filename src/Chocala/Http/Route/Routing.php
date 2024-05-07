<?php

namespace Chocala\Http\Route;

use InvalidArgumentException;

trait Routing
{
    public function urlPattern(): string
    {
        if (!property_exists($this, 'urlPattern') || $this->urlPattern == '') {
            throw new InvalidArgumentException(
                'Invalid \'urlPattern\' attribute in routing class -> ' .
                __CLASS__
            );
        }
        if (strpos($this->urlPattern, '/') !== 0) {
            throw new InvalidArgumentException(
                '\'urlPattern\' should be a valid path in class -> ' .
                __CLASS__
            );
        }
        return $this->urlPattern;
    }

    public function mapping(): array
    {
        if (!property_exists($this, 'mapping') || !is_array($this->mapping)) {
            throw new InvalidArgumentException(
                'Invalid \'mapping\' attribute in routing class -> ' .
                __CLASS__
            );
        }
        return $this->mapping;
    }

    public function routes(): array
    {
        if (!property_exists($this, 'routes') || !is_array($this->routes)) {
            throw new InvalidArgumentException(
                'Invalid \'routes\' attribute in routing class -> ' .
                __CLASS__
            );
        }
        return $this->routes;
    }
}
