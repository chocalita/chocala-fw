<?php

namespace Chocala\Http\Route;

interface RoutesInterface
{
    /**
     * @return string
     */
    public function urlPattern(): string;

    /**
     * @return array
     */
    public function mapping(): array;

    /**
     * @return array
     */
    public function routes(): array;
}
