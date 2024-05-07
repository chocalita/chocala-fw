<?php

namespace Chocala\System\Config;

use Chocala\Base\NotFoundException;
use Chocala\System\IO\File;

/**
 * Configurations Class
 * @author ypra
 */
class Configurations implements ConfigurationsInterface
{
    /**
     * The complete list of Configuration objects
     * @var array
     */
    protected $list = [];

    public function __construct()
    {
    }

    /**
     * @param File $file
     * @return void
     */
    public function load(File $file)
    {
        try {
            $fileContent = $file->read();
            $parts = explode("\n", $fileContent);
            $nParts = sizeof($parts);
            $nLine = 0;
            $description = '';
            while ($nLine < $nParts) {
                $line = trim($parts[$nLine]);
                if (substr($line, 0, 1) == Configuration::COMMENTOR) {
                    $description .= trim(substr($line, 1)) . ' ';
                } elseif ($line != '') {
                    $lineParts = explode(Configuration::ASSIGNATOR, $line, 2);
                    if (sizeof($lineParts) == 2) {
                        $name = trim(lcfirst($lineParts[0]));
                        $value = trim($lineParts[1]);
                        if (strpos($value, Configuration::COMMENTOR)) {
                            $nSubParts = explode(Configuration::COMMENTOR, $line, 2);
                            $value = trim($nSubParts[0]);
                            if ($description != '') {
                                $description = trim($description) . "\n";
                            }
                            $description .= trim($nSubParts[1]);
                        }
                        $this->list[$name] = new Configuration($name, $value, $description);
                        $description = '';
                    } else {
                        throw new ChocalaException(
                            ChocalaErrors::CONFIG_MALFORMED_DECLARATION .
                            ': ' . $line
                        );
                    }
                }
                $nLine++;
            }
        } catch (ChocalaException $e) {
            throw $e;
        }
    }

    /**
     * The complete list of Config objects
     * @return array
     */
    public function list(): array
    {
        return $this->list;
    }

    /**
     *
     * @param string $name
     * @return Configuration
     * @throws NotFoundException
     */
    public function config($name): Configuration
    {
        $list = $this->list();
        if (!isset($list[$name]) || !is_object($list[$name])) {
            throw new NotFoundException(sprintf('Not found configuration \'%s\'', $name));
        }
        return $list[$name];
    }

    /**
     * @param $name
     * @return string
     */
    public function value($name)
    {
        try {
            return $this->config($name)->getValue();
        } catch (NotFoundException $e) {
            return '';
        }
    }
}
