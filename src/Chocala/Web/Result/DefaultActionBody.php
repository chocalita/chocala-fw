<?php

namespace Chocala\Web\Result;

class DefaultActionBody implements ActionBodyInterface
{
    private ActionBodyInterface $actionBody;

    public function __construct()
    {
        $this->actionBody = new JsonActionBody();
    }

    public function result(ActionDataInterface $data)
    {
        return $this->actionBody->result($data);
    }
}
