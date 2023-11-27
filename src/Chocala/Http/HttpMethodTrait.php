<?php

namespace Chocala\Http;

use Exception;

trait HttpMethodTrait
{

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $id;

    /**
     * Method data
     * @var array
     */
    protected array $data = [];

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     *
     * @return array
     */
    public function data(): array
    {
        return $this->data;
    }

    /**
     *
     * @param string $key
     * @return bool
     */
    public function has($key): bool
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * Get a variable from the global var array.
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->has($key) ? $this->data[$key] : $default;
    }

    /**
     * Removes a variable in the data array.
     * @param string $key
     * @return HttpMethodInterface
     */
    public function delete($key): HttpMethodInterface
    {
        unset($this->data[$key]);
        return $this;
    }

    /**
     * Get and delete a variable from array data.
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function extract($key, $default = null)
    {
        $value = $this->get($key, $default);
        $this->delete($key);
        return $value;
    }

    /**
     * @return mixed
     */
    public function body()
    {
//        $rawInput = fopen('php://input', 'r');
//        $tempStream = fopen('php://temp', 'r+');
//        stream_copy_to_stream($rawInput, $tempStream);
//        rewind($tempStream);
//        return $tempStream;
//        $entityBody = stream_get_contents(STDIN);
//        return $entityBody;
        //TODO: get body
//        $request = new Request();
//        return $request->getBody();
        return "";
    }

    /**
     * @return string
     * @throws Exception
     */
    protected function generateId(): string
    {
        return time() . '-' . random_int(100000000, 999999999);
    }

}