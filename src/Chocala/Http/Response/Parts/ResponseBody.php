<?php

namespace Chocala\Http\Response\Parts;

class ResponseBody implements ResponseBodyInterface
{
    /**
     * @var string
     */
    protected string $type;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * MessageBody constructor.
     * @param string $type
     * @param $data
     */
    public function __construct(string $type, $data)
    {
        $this->type = $type;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function data()
    {
        return $this->data;
    }
}
