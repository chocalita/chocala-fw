<?php

namespace Chocala\Http;

interface HttpMethodInterface
{

    /**
     * @return string
     */
    public function name(): string;

    /**
     * @return string
     */
    public function id(): string;

    /**
     *
     * @return array
     */
    public function data(): array;

    /**
     * @param $key
     * @return bool
     */
    public function has($key): bool;

    /**
     * @param $key
     * @param $default
     * @return mixed
     */
    public function get($key, $default);

    /**
     * @param $key
     * @return $this
     */
    public function delete($key);

    /**
     * @param $key
     * @param $default
     * @return mixed
     */
    public function extract($key, $default);

    /**
     * @return mixed
     */
    public function body();

}