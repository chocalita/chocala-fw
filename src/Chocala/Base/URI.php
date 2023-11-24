<?php

namespace Chocala\Base;

use Chocala\Configuration\Config;

/**
 * Class to handle URIs in the framework
 *
 * @author ypra
 */
class URI implements Singleton
{

    /** Separator for parts of the URI */
    const SEPARATOR = '/';

    /**
     *
     * @var string
     */
    private $mapping = "/controller/action/id";

    /**
     * All parts of the URI
     * @var string
     */
    private $allParts = array();

    /**
     * Complete invoked URI
     * @var string
     */
    private $completeURI = null;

    /**
     * Single URI module
     * @var string
     */
    private $module = null;

    /**
     * Single URI page
     * @var string
     */
    private $controller = null;

    /**
     * Single URI action
     * @var string
     */
    private $action = null;

    /**
     * Single URI id
     * @var mixed
     */
    private $id = null;

    /**
     * URI parameters
     * @var array
     */
    private $params = array();

    /**
     * The instance object crated with singleton resources
     * @var URI
     */
    private static $instance = null;

    /**
     * Return the array of all parts of the URI
     * @return array
     */
    public function allParts()
    {
        return $this->allParts;
    }

    /**
     * Return the complete URI from page
     * @return string
     */
    public function completeURI()
    {
        return $this->completeURI;
    }

    /**
     * Return the module name
     * @return string
     */
    public function module()
    {
        return $this->module;
    }

    /**
     * Return the page name
     * @return string
     */
    public function controller()
    {
        return $this->controller;
    }

    /**
     * Return the action names
     * @return string
     */
    public function action()
    {
        return $this->action;
    }

    /**
     * Return the id value
     * @return mixed
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Return the parameters passed in the URI
     * @return array
     */
    public function params()
    {
        return $this->params;
    }

    /**
     * Return the instance object
     * @return URI
     */
    public static function instance()
    {
        if (!is_object(self::$instance)) {
            self::$instance = new self();
            //TODO: URL mapping routing
            $requestUrl = $_REQUEST['url'];
            if ($requestUrl != null) {
                $nVars = explode(self::SEPARATOR, $requestUrl);
                foreach ($nVars as $nVar) {
                    if (trim($nVar) != '') {
                        array_push(self::$instance->allParts, $nVar);
                    }
                }
                self::$instance->completeURI = implode(self::SEPARATOR, self::$instance->allParts);
                $vars = self::$instance->allParts;
                $size = sizeof($vars);
                $isMod = ChocalaVars::asBoolean(Config::_('app.run.modular'))
                    || ChocalaAlias::isAlias($vars[0]);
                $idxM = $isMod ? 0 : -1;
                $idxP = $isMod ? 1 : 0;
                $idxA = $isMod ? 2 : 1;
                //$vars = explode(self::SEPARATOR, self::$instance->completeURI);
                if ($size > 1) {
                    self::$instance->module = $vars[$idxM];
                    self::$instance->controller = $vars[$idxP];
                    if (isset($vars[$idxA])) {
                        $level = $idxA + 1;
                        if (is_numeric($vars[$idxA])) {
                            self::$instance->id = $vars[$idxA];
                        } else {
                            self::$instance->action = $vars[$idxA];
                            if (isset($vars[$level])) {
                                self::$instance->id = $vars[$level];
                                $level++;
                            }
                        }
                        for ($i = $level; $i < $size; $i++) {
                            array_push(self::$instance->params, $vars[$i]);
                        }
                    }
                } elseif ($size == 1) {
                    if ($isMod) {
                        self::$instance->module = Config::_('app.default.module');
                    }
                    self::$instance->controller = Config::_('app.default.controller');
                    self::$instance->action = Config::_('app.default.action');
                    if (strpos($vars[0], '.')) {
                        $varsA = explode('.', $vars[0]);
                        self::$instance->action = $varsA[0];
                    } elseif ($isMod) {
                        self::$instance->module = $vars[0];
                    } else {
                        self::$instance->controller = $vars[0];
                    }
                }
            }
        }
        return self::$instance;
    }

//    private function __construct($requestUrl, $rrr)
//    {
//
//    }

    /**
     * Return a determinate parameter
     * @param int $n
     * @return string
     */
    public static function param($n)
    {
        return self::instance()->params[$n];
    }

    /**
     *
     * Return the URI to real module
     * @param boolean $rooted
     * @return string
     */
    public static function toModule($rooted = true)
    {
        return ($rooted ? WEB_ROOT : '') .
            (ChocalaVars::asBoolean(Config::_('app.run.modular')) ||
            ChocalaAlias::isAlias(self::instance()->module) ?
                self::instance()->module . self::SEPARATOR : '');
    }

    /**
     * Return the URI to real module and page
     * @param boolean $rooted
     * @param boolean $withModule
     * @return string
     */
    public static function toPage($rooted = true, $withModule = true)
    {
        return ($withModule ? self::toModule($rooted) : '') .
            (self::instance()->controller == '' ? '' :
                self::instance()->controller . self::SEPARATOR);
    }

    /**
     * Return the URI to real module, page and action
     * @param boolean $rooted
     * @param boolean $wihModule
     * @return string
     */
    public static function toAction($rooted = true, $wihModule = true)
    {
        return self::toPage($rooted, $wihModule) .
            (self::instance()->action == '' ? '' :
                self::instance()->action . self::SEPARATOR);
    }

    /**
     * Return the URI to real module, page, action and id
     * @param boolean $rooted
     * @param boolean $wihModule
     * @return string
     */
    public static function toId($rooted = true, $wihModule = true)
    {
        return self::toAction($rooted, $wihModule) . (self::instance()->id == '' ?
                '' : self::instance()->id . self::SEPARATOR);
    }

    /**
     *
     * @param string $url
     * @param boolean $secure
     * @return string
     */
    public static function regulateHttp($url, $secure = false)
    {
        $init = 'http://';
        $initS = 'https://';
        return ($secure ? $initS : $initS) .
            str_replace($init, '', str_replace($initS, '', $url));
    }

    /**
     *
     * @param string $url
     * @return string
     */
    public static function simpleURL($url)
    {
        $init = 'http://';
        $initS = 'https://';
        return str_replace($init, '', str_replace($initS, '', $url));
    }

    /**
     *
     * @param string $url
     * @return string
     */
    public static function fixedURL($url)
    {
        return $url;
    }

    /**
     *
     * @return array
     */
    public static function subsequentURIs()
    {
        $uris = array();
        ChocalaVars::asBoolean(Config::_('app.run.modular')) ?
            array_push($uris, self::toModule(false)) : null;
        if (self::instance()->controller() != '') {
            array_push($uris, self::toPage(false, false));
            if (self::instance()->action() != '') {
                array_push($uris, self::toAction(false, false));
                if (self::instance()->id() != '') {
                    array_push($uris, self::toId(false, false));
                }
                //TODO: add URIs with params and get request
            }
        }
        return $uris;
    }

    /**
     *
     * @param array $arrayMap
     * @return string
     */
    public static function createURLTo($arrayMap)
    {
        if (isset($arrayMap['url'])) {
            return $arrayMap['url'];
        } elseif (isset($arrayMap['uri'])) {
            return WEB_ROOT . (isset($arrayMap['module']) &&
                ChocalaVars::asBoolean(Config::_('app.run.modular')) ?
                    $arrayMap['module'] . '/' : '') . $arrayMap['uri'];
        } else {
            $URI = (isset($arrayMap['module']) &&
                ChocalaVars::asBoolean(Config::_('app.run.modular'))) ?
                WEB_ROOT . $arrayMap['module'] . '/' : self::toModule();
            if (isset($arrayMap['controller'])) {
                $URI .= $arrayMap['controller'] . '/';
            } elseif (!isset($arrayMap['module']) ||
                !ChocalaVars::asBoolean(Config::_('app.run.modular'))) {
                $URI = self::toPage();
            }
            if (isset($arrayMap['action'])) {
                $URI .= $arrayMap['action'] . '/';
            } elseif (!isset($arrayMap['controller'])) {
                $URI = self::toAction();
            }
            if (isset($arrayMap['id'])) {
                if (!isset($arrayMap['controller'])) {
                    $URI .= Config::_('app.default.controller') . '/';
                }
                if (!isset($arrayMap['action'])) {
                    $URI .= Config::_('app.default.action') . '/';
                }
                $URI .= $arrayMap['id'];
            } elseif (!isset($arrayMap['action']) && !isset($arrayMap['controller'])) {
                $URI = self::toId();
            }
            if (isset($arrayMap['params']) && is_array($arrayMap['params'])
                && sizeof($arrayMap['params']) > 0) {
                $URI .= '?' . implode('&', array_walk($arrayMap['params'],
                        function (&$v, $k) {
                            $v = $k . '=' . $v;
                        }));
            }
            return $URI;
        }
    }

}