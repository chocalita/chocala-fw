<?php

namespace Chocala\Web\Result\Fakes;

use Chocala\Web\Result\ActionData;
use Chocala\Web\Result\ActionDataInterface;

class FakeActionData implements ActionDataInterface
{
    public const DEFAULT_DATA = [
        'name' => 'John',
        'lastname' => 'Doe',
        'age' => 25,
        'address' => [
            'street' => 'simpre viva',
            'number' => '1840-B'
        ]
    ];

    private ActionDataInterface $actionData;

    public function __construct(array $vars = self::DEFAULT_DATA)
    {
        $this->actionData = new ActionData();
        $this->actionData->setVars($vars);
    }

    public function vars(): array
    {
        return $this->actionData->vars();
    }

    public function setVar(string $name, $value): void
    {
        $this->actionData->setVar($name, $value);
    }

    public function setVars(array $vars): void
    {
        $this->actionData->setVars($vars);
    }

    public function __toString(): string
    {
        return $this->actionData->__toString();
    }
}
