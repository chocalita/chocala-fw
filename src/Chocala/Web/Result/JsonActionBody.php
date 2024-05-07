<?php

namespace Chocala\Web\Result;

class JsonActionBody implements ActionBodyInterface
{
    public function result(ActionDataInterface $data)
    {
        $vars = $data->vars();
        return json_encode($vars);
    }
}
