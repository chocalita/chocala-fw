<?php

namespace Chocala\Base;

interface ObjectResourcesInterface
{
    public function register(string $name, $resource);

    public function update(string $name, $resource);

    public function remove(string $name);

    public function resource(string $name);
}
