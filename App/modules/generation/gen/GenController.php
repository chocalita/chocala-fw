<?php
/**
 * Description of IndexController
 *
 * @author ypra
 */
class GenController extends WebController
{

    public function index()
    {
    }

    public function dbConfigs()
    {
        $env = Configs::value('app.run.environment');
        $conf = DBConfig::envConfigs($env);
        $this->set('env', $env);
        $this->set('conf', $conf);
    }

    public function classes()
    {
        $env = Configs::value('app.run.environment');
        $conf = DBConfig::envConfigs($env);
        $this->set('env', $env);
        $this->set('conf', $conf);
        $this->set('dsn', DBConfig::dsn($conf));
    }

    public function mapping()
    {
        $reverseLog = $mappingLog = '';
        CodeGenerator::generateGenerationConfigs();
        CodeGenerator::includePhingAndPropel();
        if(Req::has('reverse')){
            $reverseLog = CodeGenerator::generateSchema();
        }
        if(Req::has('mapping')){
            $mappingLog = CodeGenerator::generateMapping();
        }
        /**
        // Bash generation way
        $result = '';
        $phpinfo = Configs::phpinfo();
        $PHP_COMMAND = $phpinfo['Environment']['PHP_COMMANDS'];
        $dirs = ['generator', 'mapping', 'gen'];
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){
            if(Req::has('reverse')){
                $result.= system(CHOCALA_DIR.implode(DIRECTORY_SEPARATOR,$dirs).
                        ' '.$PHP_COMMAND.
                        ' reverse > '.MAPPING_DIR.'output'.DIRECTORY_SEPARATOR.
                        time().'-rev.log');
            }
            if(Req::has('mapping')){
                $result.= system(CHOCALA_DIR.implode(DIRECTORY_SEPARATOR,$dirs).
                        ' '.$PHP_COMMAND.
                        ' > '.MAPPING_DIR.'output'.DIRECTORY_SEPARATOR.time().
                        '-gen.log');
            }
        } else {
            echo "Linux Bash";
        }
        /**/
        $env = Configs::value('app.run.environment');
        $conf = DBConfig::envConfigs($env);
        $this->set('env', $env);
        $this->set('conf', $conf);
        $this->set('dsn', DBConfig::dsn($conf));
        $this->set('reverseLog', $reverseLog);
        $this->set('mappingLog', $mappingLog);
    }

    public function domains()
    {
        $mapedClasses = ClassMapHelper::mapDirRead(DOMAIN_DIR);
        ksort($mapedClasses);
        $this->set('mapedClasses', $mapedClasses);
    }

    public function domainClass()
    {
        $isModularMode = ChocalaVars::asBoolean(Configs::value('app.run.modular'));
        $mapedClasses = ClassMapHelper::mapDirRead(DOMAIN_DIR);
        if(isset($mapedClasses[$this->id])){
            $mapedClass = $this->id;
//            echo $mapedClass; exit();
            $mapedColumns = ClassMapHelper::columnsFrom($mapedClass);
            foreach ($mapedColumns as $mc){
                //print_r($mc);
            }
            $this->set('isModularMode', $isModularMode);
            $this->set('mapedClass', $mapedClass);
            $this->set('mapedColumns', $mapedColumns);
            if($isModularMode){
                $this->set('modules', ClassMapHelper::modules(MODULES_DIR));
            }
        }else{
            header('Location: '.WEB_ROOT.URI::toPage());
            exit();
        }
    }

    public function scaffolding()
    {
        $isModularMode = ChocalaVars::asBoolean(Configs::value('app.run.modular'));
        $mapedClasses = ClassMapHelper::mapDirRead(DOMAIN_DIR);
        $modelName = Req::_('_model_name');
        $module = Req::_('_module');
        if(isset($mapedClasses[$this->id]) && $modelName != ''){// &&
            //!($isModularMode && $module == '')){
            $mapedClass = $this->id;
            $mapedColumns = ClassMapHelper::columnsFrom($mapedClass);
            $mapedColumsGen = array_filter($mapedColumns, function($obj){
                return Req::has('_'.$obj->getName());
            });
            $hashColumns = array();
            foreach ($mapedColumsGen as $mcKey => $columnMap){
                $hashColumns[$columnMap->getName()] = ['maped' => $columnMap];
                if($columnMap->isForeignKey()){
                    $hashColumns[$columnMap->getName()]['field'] =
                            Req::_('_field_'.$columnMap->getName());
                }
            }
            $mapedHash = [
                'modelName' => $modelName,
                'className' => $mapedClass,
                'mapedColumns' => $mapedColumns,
                'hashColumns' => $hashColumns
            ];
            CodeGenerator::generateService($mapedHash, $module);
            CodeGenerator::generateController($mapedHash, $module);
            CodeGenerator::generateViews($mapedHash, $module);
            $this->set('mapedClass', $mapedClass);
            $this->set('views', CodeGenerator::$views);
        }else{
            header('Location: '.URI::toPage());
            exit();
        }
    }

}