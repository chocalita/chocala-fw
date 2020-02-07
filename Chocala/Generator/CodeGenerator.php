<?php
/**
 * Description of CodeGenerator
 *
 * @author ypra
 */
class CodeGenerator
{

    const TAG_OPEN_SHORT = '<?=';

    const TAG_OPEN = '<?php';

    const TAG_CLOSE = '?>';

    const MAIN_CLASS = 'index';

    const SERVICE_SUFFIX = 'Service';

    const SERVICE_EXTENSION = '.php';

    const CONTROLLER_SUFFIX = 'Controller';

    const CONTROLLER_EXTENSION = '.php';

    const TEMPLATE_EXTENSION = '.phtml';

    const CODE_CONTROLLER_FILE = 'class.gen';

    const CODE_FUNCTION_FILE = 'function.gen';

    const VIEW_FILE_LIST = 'dataList';

    const VIEW_FILE_SHOW = 'show';

    const VIEW_FILE_CREATE = 'create';

    const VIEW_FILE_EDIT = 'edit';

    const VIEW_FILE_FORM = 'form';

    const CODE_TEMPLATE_FILE = 'template.gen';

    /**
     *
     * @var type 
     */
    public static $views = array('dataList', 'show', 'create', 'edit', 'form');
            
    /**
     * 
     * @return string
     */
    public static function genPath()
    {
        return SYSTEM_DIR.'generator'.DIRECTORY_SEPARATOR;
    }

    /**
     * 
     * @return string
     */
    public static function mappingPath()
    {
        return self::genPath().'mapping'.DIRECTORY_SEPARATOR;
    }

    /**
     * 
     * @return string
     */
    public static function templatesPath()
    {
        return self::genPath().'templates'.DIRECTORY_SEPARATOR;
    }

    /**
     * 
     * @param string $module
     * @return string
     */
    public static function modelPath($modelName, $module='')
    {
        return MODULES_DIR.($module!=''? $module.DIRECTORY_SEPARATOR: '').
            lcfirst($modelName).DIRECTORY_SEPARATOR;
    }

    /**
     *
     * @param string $module
     * @return string
     */
    public static function controllerPath($controllerName, $module='')
    {
        return MODULES_DIR.($module!=''? $module.DIRECTORY_SEPARATOR: '').
            lcfirst($controllerName).DIRECTORY_SEPARATOR;
    }

    /**
     * 
     * @param string $className
     * @param string $module
     * @return string
     */
    public static function viewsPath($className, $module='')
    {
        return MODULES_DIR.($module!=''? $module.DIRECTORY_SEPARATOR: '').
            lcfirst($className).DIRECTORY_SEPARATOR;
    }

    /**
     *
     * @param string $name
     * @return string
     */
    public static function controllerName($name)
    {
        return ucfirst($name).self::CONTROLLER_SUFFIX;
    }

    /**
     * 
     * @param Module $module
     * @return string
     */
    public static function createModule(Module $module)
    {
        $moduleControlPath = APP_DIR.$module->URI();
        $moduleViewPath = TEMPLATES_DIR.$module->URI();
        if(!file_exists($moduleControlPath)){
            mkdir($moduleControlPath);
        }
        if(!file_exists($moduleViewPath)){
            mkdir($moduleViewPath);
        }
        self::createController($module->URI(), self::MAIN_CLASS, true, $fs);
        return ;
    }

    /**
     * 
     * @param string $className
     * @param string $modelName
     * @return array
     */
    public static function generateReplacements($className, $modelName='')
    {
        $classAsPreffix = lcfirst($className);
        return array(
            '#CLASS_NAME#' => ucfirst($className),
            '#CLASS_PAGER#' => "\${$classAsPreffix}Pager",
            '#CLASS_PAGER_TO_VIEW#' => "{$classAsPreffix}Pager",
            '#CLASS_INSTANCE#' => "\${$classAsPreffix}",
            '#CLASS_INSTANCE_TO_VIEW#' => "{$classAsPreffix}",
//            '#CLASS_INSTANCE#' => "\${$classAsPreffix}Instance",
//            '#CLASS_INSTANCE_TO_VIEW#' => "{$classAsPreffix}Instance",
            '#MODEL_CLASS_NAME#' => $modelName!=''? ucfirst($modelName): ucfirst($className),
            '#MODEL_NAME#' => $modelName!=''? lcfirst($modelName): lcfirst($className)
        );
    }

    /**
     * 
     * @param string $modelName
     * @param string $module
     * @return boolean
     */
    public static function createModelDirectory($modelName, $module='')
    {
        $modelPath = self::modelPath($modelName, $module);
        if(!file_exists($modelPath)){
            return mkdir($modelPath);
        }
        return true;
    }

    /**
     *
     * @param string $module
     * @return boolean
     */
    public static function createControllerDirectory($controllerName, $module='')
    {
        $moduleControllerPath = self::controllerPath($controllerName, $module);
        if(!file_exists($moduleControllerPath)){
            return mkdir($moduleControllerPath);
        }
        return false;
    }

    /**
     * 
     * @param string $className
     * @param string $module
     * @return boolean
     */
    public static function createViewsDirectory($className, $module='')
    {
        $moduleViewsPath = self::viewsPath($className, $module);
        if(!file_exists($moduleViewsPath)){
            return mkdir($moduleViewsPath);
        }
        return false;
    }

    /**
     * 
     * @param string $className
     * @param string $module
     * @return boolean
     */
    public static function generateService($mapedHash, $module='')
    {
        $className = $mapedHash['className'];
        $modelName = $mapedHash['modelName'];
        $mapedColumns = isset($mapedHash['mapedColumns'])?
                $mapedHash['mapedColumns']:
            ClassMapHelper::columnsFrom($className);
        $hashColumns = isset($mapedHash['hashColumns'])?
                $mapedHash['hashColumns']: array_map( function($obj){
                    return array('maped' => $obj);
                }, array_filter($mapedColumns, function($obj){
                    return !$obj->isPrimaryKey() && !$obj->isForeignKey();
                }));
        $pkColumns = array_filter($mapedColumns, function($obj){
            return $obj->isPrimaryKey();
        });
        ob_start();
        include_once self::templatesPath().self::SERVICE_SUFFIX.
            self::SERVICE_EXTENSION;
        $content = ob_get_contents();
        ob_end_clean();
        $replacements = self::generateReplacements($className, $modelName);
        foreach ($replacements as $kRep => $vRep){
            $content = str_replace($kRep, $vRep, $content);
        }
        $modelPath = self::modelPath($modelName, $module);
        $servicePath = $modelPath.ucfirst($modelName).
            self::SERVICE_SUFFIX.Chocala::CLASS_EXTENSION;
//        echo $modelPath; exit();
        self::createModelDirectory($modelName, $module);
        return file_put_contents($servicePath, $content);
    }

    /**
     *
     * @param string $className
     * @param string $module
     * @return boolean
     */
    public static function generateController($mapedHash, $module='')
    {
        $className = $mapedHash['className'];
        $modelName = $mapedHash['modelName'];
        $mapedColumns = isset($mapedHash['mapedColumns'])?
                $mapedHash['mapedColumns']:
            ClassMapHelper::columnsFrom($className);
        $hashColumns = isset($mapedHash['hashColumns'])?
                $mapedHash['hashColumns']: array_map( function($obj){
                    return array('maped' => $obj);
                }, array_filter($mapedColumns, function($obj){
                    return !$obj->isPrimaryKey() && !$obj->isForeignKey();
                }));
        $pkColumns = array_filter($mapedColumns, function($obj){
            return $obj->isPrimaryKey();
        });
        ob_start();
        include_once self::templatesPath().self::CONTROLLER_SUFFIX.
                self::CONTROLLER_EXTENSION;
        $content = ob_get_contents();
        ob_end_clean();
        $replacements = self::generateReplacements($className, $modelName);
        foreach ($replacements as $kRep => $vRep){
            $content = str_replace($kRep, $vRep, $content);
        }
        $modelPath = self::modelPath($modelName, $module);
        $controllerPath = $modelPath.ucfirst($modelName).
            self::CONTROLLER_SUFFIX.Chocala::CLASS_EXTENSION;
        self::createModelDirectory($modelName, $module);
        return file_put_contents($controllerPath, $content);
    }

    /**
     * 
     * @param string $view
     * @param string $className
     * @param string $module
     * @return boolean
     */
    public static function generateView($view, $mapedHash, $module='')
    {
        $className = $mapedHash['className'];
        $modelName = $mapedHash['modelName'];
        $mapedColumns = isset($mapedHash['mapedColumns'])?
                $mapedHash['mapedColumns']:
            ClassMapHelper::columnsFrom($className);
        $hashColumns = isset($mapedHash['hashColumns'])?
                $mapedHash['hashColumns']: array_map( function($obj){
                    return array('maped' => $obj);
                }, array_filter($mapedColumns, function($obj){
                    return !$obj->isPrimaryKey() && !$obj->isForeignKey();
                }));
        $pkColumns = array_filter($mapedColumns, function($obj){
                    return $obj->isPrimaryKey();
                });
        ob_start();
        include_once self::templatesPath().$view.self::TEMPLATE_EXTENSION;
        $content = ob_get_contents();
        ob_end_clean();
        $replacements = self::generateReplacements($className, $modelName);
        foreach ($replacements as $kRep => $vRep){
            $content = str_replace($kRep, $vRep, $content);
        }
        $modelPath = self::modelPath($modelName, $module);
        $viewPath = $modelPath.$view.Chocala::TEMPLATE_EXTENSION;
        self::createModelDirectory($modelName, $module);
        return file_put_contents($viewPath, $content);
    }

    /**
     * 
     * @param array $mapedHash
     * @param string $module
     */
    public static function generateViews($mapedHash, $module='')
    {
        foreach (self::$views as $view){
            self::generateView($view, $mapedHash, $module);
        }
    }

    /**
     * 
     * @return void
     */
    public static function generateGenerationConfigs()
    {
        $env = Configs::value('app.run.environment');
        $conf = DBConfig::envConfigs($env);
        $dsn = DBConfig::dsn($conf);
        // creating build.properties
        $propertiesPath = self::templatesPath().'adapters'.DIRECTORY_SEPARATOR.
                $conf['adapter'].'.properties';
        $content = file_get_contents($propertiesPath);
        $content = str_replace('#DATASOURCE#', $conf['datasource'], $content);
        $content = str_replace('#APP_DIR_NAME#', APP_DIR_NAME, $content);
        $content = str_replace('#DSN#', $dsn, $content);
        $content = str_replace('#USER#', $conf['user'], $content);
        $content = str_replace('#PASSWORD#', $conf['password'], $content);
        $runtimeFilePath = self::mappingPath().'build.properties';
        file_put_contents($runtimeFilePath, $content);
        // creating runtime-conf.xml
        $runtimePath = self::templatesPath().'adapters'.DIRECTORY_SEPARATOR.
                'runtime-conf.xml';
        $content = file_get_contents($runtimePath);
        $content = str_replace('#DBNAME#', $conf['dbname'], $content);
        $content = str_replace('#ADAPTER#', $conf['adapter'], $content);
        $content = str_replace('#DSN#', $dsn, $content);
        $content = str_replace('#USER#', $conf['user'], $content);
        $content = str_replace('#PASSWORD#', $conf['password'], $content);
        $runtimeFilePath = self::mappingPath().'runtime-conf.xml';
        file_put_contents($runtimeFilePath, $content);
    }
    
    /**
     * Includes Phing class and set into path the phing class directory and 
     * propel lib directory too
     * @return void
     */
    public static function includePhingAndPropel()
    {
        set_include_path(realpath(LIB_DIR.'phing/classes').PATH_SEPARATOR.
                ORM_DIR.'propel/generator/lib/'.PATH_SEPARATOR.
                get_include_path());
        require_once('phing/Phing.php');
    }

    /**
     * 
     * @param string $filename
     * @param string $args
     */
    public static function proccessPropelByPhing($filename, $arguments=null)
    {
        try {
            /* Setup Phing environment */
            Phing::startup();
            // Set phing.home property to the value from environment,
            // this may be NULL, but that's not a big problem.
            Phing::setProperty('phing.home', getenv('PHING_HOME'));
            Phing::setOutputStream(new OutputStream(fopen(MAPPING_DIR.'output'.
                    DIRECTORY_SEPARATOR.$filename, "w")));
            $buildXmlArray = array('propel', 'generator', 'build.xml');
            $projectDirArray = array('generator', 'mapping');
            $args = array('', '-f',
                ORM_DIR.implode(DIRECTORY_SEPARATOR, $buildXmlArray),
                '-Dusing.propel-gen=true',
                '-Dproject.dir='.CHOCALA_DIR.implode(DIRECTORY_SEPARATOR,
                        $projectDirArray));
            if($arguments){
                $args[] = $arguments;
            }
            array_shift($args);// 1st arg is script name, so drop it
            // Invoke the commandline entry point
            Phing::fire($args);
            // Invoke any shutdown routines.
            Phing::shutdown();
        } catch (ConfigurationException $x) {
            Phing::printMessage($x);
            exit(-1);// This was convention previously for configuration errors.
        } catch (Exception $x) {
            // Assume the message was already printed as part of the build and
            // exit with non-0 error code.
            exit(1);
        }
    }

    /**
     * 
     * @return string
     */
    public static function generateSchema()
    {
        $filename = time().'-'.'rev.log';
        self::proccessPropelByPhing($filename, 'reverse');
        return $filename;
    }

    /**
     * 
     * @return string
     */
    public static function generateMapping()
    {
        $filename = time().'-'.'gen.log';
        set_include_path(realpath(ORM_DIR.'propel/generator/lib/').
                PATH_SEPARATOR.get_include_path());
        self::proccessPropelByPhing($filename);
        return $filename;
    }

    
    public static function generateMapping1()
    {
        self::includePhingAndPropel();
        try {
            /* Setup Phing environment */
            Phing::startup();
            echo getenv('PHING_HOME');
            echo "yecid";
            // Set phing.home property to the value from environment
            // (this may be NULL, but that's not a big problem.)
            Phing::setProperty('phing.home', getenv('PHING_HOME'));
            Phing::setOutputStream(new OutputStream(fopen("C://wamp/mys.txt", "w")));            
            Phing::setOutputStream(new OutputStream(fopen(MAPPING_DIR.'output'.DIRECTORY_SEPARATOR.time().'-rev.log', "w")));
            //self::$out = new OutputStream(fopen("C://wamp/my.txt", "w"));

//            $argv = array("ddd", "-f", ORM_DIR."propel\generator\build.xml", "-Dusing.propel-gen=true", "-Dproject.dir=".CHOCALA_DIR."generator\mapping");
            $argv = array("ddd", "-f", ORM_DIR."propel\generator\build.xml", "-Dusing.propel-gen=true", "-Dproject.dir=".CHOCALA_DIR."generator\mapping");
            // Grab and clean up the CLI arguments
            $args = isset($argv) ? $argv : $_SERVER['argv']; // $_SERVER['argv'] seems to not work (sometimes?) when argv is registered
            //print_r($argv); exit();
            array_shift($args); // 1st arg is script name, so drop it

            // Invoke the commandline entry point
            Phing::fire($args);
            
            // Invoke any shutdown routines.
            Phing::shutdown();
        } catch (ConfigurationException $x) {
            Phing::printMessage($x);
            exit(-1); // This was convention previously for configuration errors.
        } catch (Exception $x) {
            // Assume the message was already printed as part of the build and
            // exit with non-0 error code.
            exit(1);
        }
    }

}