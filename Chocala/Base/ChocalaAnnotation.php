<?php
/**
 *
 * @author: ypra
 * Date: 1/22/2016
 * Time: 12:06 a.m.
 */
class ChocalaAnnotation
{

    private $tags = array();
    private $filters = array();
    private $oTags = array();
    private $object;
    private $method;

//    private function read($docBlock, $aFilters)
    public function read($docBlock, $aFilters)
    {
        $annotations = array();
        // read method annotations
        if ($docBlock) {
            foreach (explode("\n", $docBlock) as $docLine) {
                $docLine = preg_replace('/^\/\*\*\s*|^\s*\*\s*|\s*\*\/$|\s*$/', '', $docLine);
                if (preg_match('/^\@('.$aFilters.')\s*(.*)?$/i', $docLine, $matches)) {
                    $annotations[] = strtolower($matches[1]);
                }elseif(strstr($docLine, "@ignore_")){
                    $match = str_replace("@","",$docLine);
                    $annotations[] = strtolower($match);
                }
            }
        }
        return $annotations;
    }
    //put your code here
//    private function getTags($comment, $aKeyFilters)
    public function getTags($comment, $aKeyFilters)
    {
        $array = $this->read($comment, $aKeyFilters);
        if(count($array)>0){
            foreach ($array as $value) {
                $value = trim($value);
                if($value && $value!=""){
                    if(isset($this->filters[$value])){
                        $this->tags[$value] = $this->filters[$value];
                    }elseif(strstr($value, "ignore_")){
                        $tag = str_replace("ignore_", "", $value);
                        if(isset($this->tags[$tag])){
                            unset($this->tags[$tag]);
                        }
                    }
                }
            }
        }
    }

    public function processComment($object, $methodName, $aFilters)
    {
        $this->object = $object;
        $this->method = $methodName;
        $this->tags = array();
        $this->filters = $aFilters;
        $c = new ReflectionClass(get_class($object));
        $m = $c->getMethod($methodName);
        $aKeyFilters = implode("|", array_keys($this->filters));
        $this->getTags($c->getDocComment(), $aKeyFilters);
        $this->getTags($m->getDocComment(), $aKeyFilters);
        return $this;
    }

    public function getArray()
    {
        return $this->tags;
    }



}