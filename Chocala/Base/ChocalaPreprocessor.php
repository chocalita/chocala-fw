<?php

/**
 * Class ChocalaPreprocessor
 */
class ChocalaPreprocessor
{

    /**
     * @param $object
     * @param $excludes
     * @return ReflectionProperty[]
     */
    public static function properties($object, $excludes)
    {
        $c = new ReflectionClass(get_class($object));
        return $c->getProperties();
    }

    public static function preprocessServices($controller)
    {
        $properties = self::properties($controller);
        foreach ($properties as $property) {
            $doc = $property->getDocComment();
            preg_match_all('#@(.*?)\n#s', $doc, $annotations);
//            print_r($annotations);
//            $tags = $pr->read($property->getDocComment(), 'service');
//            print_r($tags);
//            echo "<br /> Otra forma";
            $aFilters = 'service';
            $service = '';
            foreach (explode("\n", $doc) as $docLine) {
                $docLine = preg_replace('/^\/\*\*\s*|^\s*\*\s*|\s*\*\/$|\s*$/', '', $docLine);
                if (preg_match('/^\@('.$aFilters.')\s*(.*)?$/i', $docLine, $matches)) {
                    $explodes = explode(" ", $matches[2]);
                    $service = trim($explodes[0]);
                }
            }
            if($service != ''){
                if(strpos($service, '.')){
                    Chocala::import('Modules.'.$service);
                    $parts = explode('.', $service);
                    $service = $parts[sizeof($parts)-1];
                }else{
                    $classname = get_class($controller);
                    $c = new ReflectionClass($classname);
                    $serviceFile = str_replace($classname, $service, $c->getFileName());
                    if(file_exists($serviceFile)){
                        require_once($serviceFile);
                    }else{
                        //TODO: importar dentro del mismo módulo o de manera general
                        throw new ChocalaException('Service file not fount');
                    }
                }
                $propertyName = $property->getName();
                //TODO: implementar como Singleton
                $controller->$propertyName = class_implements($service, 'ISingleton')?
                    $service::instance(): new $service();
                if(is_object($controller->$propertyName)){
                    self::preprocessServices($controller->$propertyName);
                }
            }
        }
    }

}