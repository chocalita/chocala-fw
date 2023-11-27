<?php

namespace Chocala\Http\IO;

class InputStream implements InputStreamInterface
{

    /**
     * @var string
     */
    private string $content;

    public function __construct()
    {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();
        if (method_exists($this, $method_name = '__construct' . $number_of_arguments)) {
            call_user_func_array([$this, $method_name], $get_arguments);
        } else {
            throw new \InvalidArgumentException('Invalid arguments to create object ' . __CLASS__);
        }
    }

    private function __constructor(string $content)
    {
        $this->content = $content;
    }

    private function __construct0()
    {
        return $this->__constructor(file_get_contents('php://input'));
    }

    private function __construct1($content)
    {
        if (!is_string($content)) {
            throw new \InvalidArgumentException('Invalid arguments to create object ' . __CLASS__);
        }
        return $this->__constructor($content);
    }

    /**
     * @inheritDoc
     */
    public function content(): string
    {
        return $this->content;
    }

}