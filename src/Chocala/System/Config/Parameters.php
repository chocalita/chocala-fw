<?php

namespace Chocala\System\Config;

use Chocala\Base\IllegalStateException;
use Chocala\Base\NotFoundException;
use Chocala\System\IO\File;

class Parameters implements ParametersInterface
{
    /**
     * XML manager
     * @var SimpleXMLElement
     */
    private $xmlObject;

    /**
     * The complete list of Parameter objects
     * @var array
     */
    private $list = [];

    public function __construct()
    {
    }

    /**
     * @param File $file
     * @return void
     */
    public function load(File $file)
    {
        $this->xmlObject = simplexml_load_string($file->read());
        $params = $this->xmlObject->children();
        foreach ($params as $param) {
            $name = utf8_decode(trim($param['name']));
            $value = utf8_decode(trim($param['value']));
            $type = utf8_decode(trim($param['type']));
            $access = utf8_decode(trim($param['access']));
            $description = utf8_decode(trim($param->description));
            $options = [];
            if ($type == Parameter::TYPE_LIST) {
                foreach ($param->options->children() as $opt) {
                    $option = utf8_decode(trim($opt));
                    $options[$option] = $option;
                }
            } elseif ($type == Parameter::TYPE_SEQUENTIAL) {
                $opChilds = $param->options->children();
                $i = $opChilds[0] * 1;
                $j = $opChilds[1] * 1;
                if ($i > $j) {
                    for ($n = $i; $n <= $j; $n++) {
                        $options[$n] = $n;
                    }
                } else {
                    for ($n = $j; $n >= $i; $n--) {
                        $options[$n] = $n;
                    }
                }
            }
            $this->list[$name] = new Parameter(
                $name,
                $value,
                $type,
                $access,
                $description,
                $options
            );
        }
    }

    /**
     * @return array
     */
    public function list(): array
    {
        if (is_null($this->xmlObject)) {
            throw new IllegalStateException('XML file isn\'t loaded');
        }
        return $this->list;
    }

    /**
     * @param $name
     * @return Parameter
     * @throws NotFoundException
     */
    public function param($name): Parameter
    {
        $list = $this->list();
        if (!isset($list[$name]) || !is_object($list[$name])) {
            throw new NotFoundException(sprintf('Not found parameter config \'%s\'', $name));
        }
        return $list[$name];
    }

    /**
     * @param $name
     * @return Parameter
     */
    public function value($name)
    {
        try {
            return $this->param($name)->getValue();
        } catch (NotFoundException $e) {
            return '';
        }
    }
}
