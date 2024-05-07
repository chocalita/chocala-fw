<?php

namespace Chocala\Base;

class GlobalObjectResources implements ObjectResourcesInterface, Singleton
{
    use Singletonized;

    /**
     * @var ObjectResourcesInterface
     */
    private $objectResource;

    private function __construct()
    {
        $this->objectResource = new ObjectResources();
    }

    /**
     * @param string $name
     * @param $resource
     * @throws UnsupportedOperationException | IllegalArgumentException
     */
    public function register(string $name, $resource)
    {
        $this->objectResource->register($name, $resource);
    }

    /**
     * @param string $name
     * @param $resource
     * @throws IllegalArgumentException
     */
    public function update(string $name, $resource)
    {
        $this->objectResource->update($name, $resource);
    }

    /**
     * @param string $name
     * @return mixed
     * @throws NotFoundException
     */
    public function remove(string $name)
    {
        $this->objectResource->remove($name);
    }

    /**
     * @param string $name
     * @return mixed
     * @throws NotFoundException
     */
    public function resource(string $name)
    {
        return $this->objectResource->resource($name);
    }
}
