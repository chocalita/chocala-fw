<?php

namespace Chocala\Web\Result;

use Chocala\Base\UnsupportedOperationException;

class TextActionData implements ActionDataInterface
{
    public const VAR_NEY_NAME = 'message';

    private ActionDataInterface $actionData;

    public function __construct(string $value)
    {
        $this->actionData = new ActionData();
        $this->actionData->setVar(self::VAR_NEY_NAME, $value);
    }

    public function vars(): array
    {
        return $this->actionData->vars();
    }

    public function setVar(string $name, $value): void
    {
        $this->actionData->setVar(self::VAR_NEY_NAME, $value);
    }

    public function setVars(array $vars): void
    {
        throw new UnsupportedOperationException('TextActionData couldn\'t set multiple variables in data.');
    }

    public function __toString(): string
    {
        if (sizeof($this->actionData->vars()) > 0) {
            return $this->actionData->vars()[self::VAR_NEY_NAME];
        }
        return '';
    }
}
