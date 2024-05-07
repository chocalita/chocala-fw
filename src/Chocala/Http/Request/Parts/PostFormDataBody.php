<?php

namespace Chocala\Http\Request\Parts;

use Chocala\Base\IllegalStateException;
use InvalidArgumentException;

class PostFormDataBody extends FormDataBody implements MessageBodyInterface
{
    /**
     * @throws InvalidArgumentException
     */
    public function __construct()
    {
        if (func_num_args() > 0) {
            throw new InvalidArgumentException('Too many arguments to create object ' . __CLASS__);
        }
        // override data, because it's referenced to global $_POST var
        parent::__construct([]);
        $this->data = &$_POST;
    }

    /**
     * @return array
     * @throws IllegalStateException
     */
    public function data(): array
    {
        if ($this->data === null) {
            throw new IllegalStateException('Data resource is null ' . __CLASS__);
        }
        return $this->data;
    }
}
