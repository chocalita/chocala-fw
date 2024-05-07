<?php

namespace Chocala\Http\Request\Parts;

use InvalidArgumentException;

class QueryParams implements QueryParamsInterface
{
    /**
     * @var array
     */
    protected array $data;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct()
    {
        if (func_num_args() > 0) {
            throw new InvalidArgumentException('Too many arguments to create object ' . __CLASS__);
        }
        $this->data = &$_GET;
    }

    /**
     * @return array
     */
    public function data(): array
    {
        return $this->data;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * @param $key
     * @param $default
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        return $this->has($key) ? $this->data[$key] : $default;
    }

    /**
     * Removes a variable in the data array.
     * @param string $key
     * @return QueryParamsInterface
     */
    public function delete(string $key): QueryParamsInterface
    {
        unset($this->data[$key]);
        return $this;
    }

    /**
     * Get and delete a variable from array data.
     * @param $key
     * @param $default
     * @return mixed|null
     */
    public function extract($key, $default = null)
    {
        $value = $this->get($key, $default);
        $this->delete($key);
        return $value;
    }
}
