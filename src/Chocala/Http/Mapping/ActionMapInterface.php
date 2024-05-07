<?php

namespace Chocala\Http\Mapping;

interface ActionMapInterface
{
    /**
     * @return string
     */
    public function module(): string;

    /**
     * @return string
     */
    public function controller(): string;

    /**
     * @return string
     */
    public function action(): string;

    /**
     * @return mixed
     */
    public function id();

    /**
     * @return array
     */
    public function params(): array;
}
