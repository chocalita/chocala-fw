<?php

namespace Chocala\Web\Result;

class PrintActionBody implements ActionBodyInterface
{
    public function result(ActionDataInterface $data)
    {
        return print_r($data->vars(), true);
    }
}
