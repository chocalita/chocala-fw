<?php

namespace Chocala\Base;

class ObjectResources implements ObjectResourcesInterface
{

    private array $resources;

    public function __construct()
    {
        $this->resources = [];
    }

    /**
     * @param string $name
     * @param $resource
     * @throws UnsupportedOperationException | IllegalArgumentException
     */
    public function register(string $name, $resource)
    {
        if (isset($this->resources[$name])) {
            throw new UnsupportedOperationException(sprintf('Could not register resource \'%s\' because it\'s already exists.', $name));
        }
        $this->update($name, $resource);
    }

    /**
     * @param string $name
     * @param $resource
     * @throws IllegalArgumentException
     */
    public function update(string $name, $resource)
    {
        if (is_null($resource)) {
            throw new IllegalArgumentException(sprintf('Illegal register for resource \'%s\'', $name));
        }
        $this->resources[$name] = $resource;
    }

    /**
     * @param string $name
     * @return mixed
     * @throws NotFoundException
     */
    public function resource(string $name)
    {
        if (!isset($this->resources[$name])) {
            throw new NotFoundException(sprintf('Not found resource \'%s\' because it isn\'t registered', $name));
        }
        return $this->resources[$name];
    }

    /**
     * @param string $name
     * @throws NotFoundException
     */
    public function remove(string $name)
    {
        if (!isset($this->resources[$name])) {
            throw new NotFoundException(sprintf('Could not remove for resource \'%s\' because it isn\'t registered', $name));
        }
        unset($this->resources[$name]);
    }

}