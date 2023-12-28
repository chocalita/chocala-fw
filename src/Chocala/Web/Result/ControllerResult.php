<?php

namespace Chocala\Web\Result;

class ControllerResult implements ControllerResultInterface
{

    /**
     *
     * @var array
     */
    protected array $vars = [];

    final public function vars(): array
    {
        return $this->vars;
    }

    final public function setVar(string $name, $value): void
    {
        $this->vars[$name] = $value;
    }

    final public function setVars(array $vars): void
    {
        $this->vars = $vars;
    }

    public function __toString(): string
    {
        if (sizeof($this->vars) > 0) {
            return json_encode($this->vars);
        }
        return '';
    }

}