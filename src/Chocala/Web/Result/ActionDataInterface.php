<?php

namespace Chocala\Web\Result;

interface ActionDataInterface
{
    public function vars(): array;

    public function setVar(string $name, $value): void;

    public function setVars(array $vars): void;

    public function __toString(): string;
}
