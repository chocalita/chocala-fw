<?php

namespace Chocala\Configuration;

use Chocala\Base\Singleton;
use Chocala\Base\Singletonized;
use Chocala\System\Config\Parameter;
use Chocala\System\Config\Parameters;
use Chocala\System\Config\ParametersInterface;
use Chocala\System\IO\File;

/**
 * Params Class (Singleton)
 * SINGLETON Pattern
 * @author ypra
 */
class Param implements ParametersInterface, Singleton
{
    use Singletonized;

    /**
     * @var Parameters
     */
    private $parameters;

    private function __construct()
    {
        $this->parameters = new Parameters();
    }

    /**
     *
     * @param string $name
     * @return mixed
     */
    public static function _($name)
    {
        return self::instance()->parameters->value($name);
    }

    /**
     *
     * @param File $file
     * @return void
     */
    public function load(File $file)
    {
        $this->parameters->load($file);
    }

    /**
     * @return array
     */
    public function list(): array
    {
        return $this->parameters->list();
    }

    /**
     * @param $name
     * @return Parameter
     */
    public function param($name): Parameter
    {
        return $this->parameters->param($name);
    }

    /**
     * @param $name
     * @return Parameter
     */
    public function value($name)
    {
        return $this->parameters->value($name);
    }

    /**
     * Save the list of parameters using then XMLParser class in the
     * params.xml file
     * @param array $params Array of objects type Param for save
     */
    public static function saveToXML($params)
    {
        Chocala::import('System.util.XMLParser');
        $arrXML = array();
        ksort($params);
        array_push(
            $arrXML,
            array('tag' => 'params',
                'type' => XMLParser::OPEN_TAG,
                'level' => 1,
                'value' => ''
            )
        );
        foreach ($params as $param) {
            array_push(
                $arrXML,
                array(
                    'tag' => 'param',
                    'type' => XMLParser::OPEN_TAG,
                    'level' => 2,
                    'value' => '',
                    'attributes' => array(
                        'name' => utf8_encode($param->getName()),
                        'value' => utf8_encode($param->getValue()),
                        'type' => utf8_encode($param->getType()),
                        'access' => utf8_encode($param->getAccess())
                    )
                )
            );
            array_push(
                $arrXML,
                array('tag' => 'description',
                    'type' => XMLParser::COMPLETE_TAG,
                    'level' => 3,
                    'value' => utf8_encode($param->getDescription()),
                )
            );
            array_push(
                $arrXML,
                array('tag' => 'options',
                    'type' => XMLParser::OPEN_TAG,
                    'level' => 3,
                    'value' => '',
                )
            );
            foreach ($param->getOptions() as $option) {
                array_push(
                    $arrXML,
                    array('tag' => 'option',
                        'type' => XMLParser::OPEN_TAG,
                        'level' => 4,
                        'value' => utf8_encode($option),
                    )
                );
            }
            array_push(
                $arrXML,
                array('tag' => 'options',
                    'type' => XMLParser::CLOSE_TAG,
                    'level' => 3,
                    'value' => '',
                )
            );
            array_push(
                $arrXML,
                array('tag' => 'param',
                    'type' => XMLParser::CLOSE_TAG,
                    'level' => 2,
                    'value' => ''
                )
            );
        }
        array_push(
            $arrXML,
            array('tag' => 'params',
                'type' => XMLParser::CLOSE_TAG,
                'level' => 1,
                'value' => ''
            )
        );
        $parser = new XMLParser($arrXML);
        $parser->saveAs(BIN_DIR . self::PARAMS_FILE);
    }
}
