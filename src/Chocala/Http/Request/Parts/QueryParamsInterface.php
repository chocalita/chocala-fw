<?php

namespace Chocala\Http\Request\Parts;

interface QueryParamsInterface
{
    /**
     * @return array
     */
    public function data(): array;

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * @param string $key
     * @param $default
     * @return mixed
     */
    public function get(string $key, $default);

    /**
     * @param string $key
     * @return QueryParamsInterface
     */
    public function delete(string $key): QueryParamsInterface;

    /**
     * @param string $key
     * @param $default
     * @return mixed
     */
    public function extract(string $key, $default);
}
