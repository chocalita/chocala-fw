<?php

use Chocala\Base\Chocala;

/**
 * Class ChocalaAutoload
 */
class ChocalaAutoload
{

    /**
     *
     * @var array
     */
    protected static $applicationMap = array(
        'AppConfig' => 'configs/AppConfig',
        'DataSources' => 'configs/DataSources',
        'URLMapping' => 'configs/URLMapping'
    );

    /**
     * @var array
     */
    protected static $autoloadMap = array(
/*
        'Chocala' => 'Base/Chocala',
        'ChocalaAlias' => 'Base/ChocalaAlias',
        'ChocalaAnnotation' => 'Base/ChocalaAnnotation',
        'ChocalaBase' => 'Base/ChocalaBase',
        'ChocalaErrors' => 'Base/ChocalaErrors',
        'ChocalaErrorsManager' => 'Base/ChocalaErrorsManager',
        'ChocalaException' => 'Base/ChocalaException',
        'ChocalaFilter' => 'Base/ChocalaFilter',
        'ChocalaFiltersManager' => 'Base/ChocalaFiltersManager',
        'ChocalaI18N' => 'Base/ChocalaI18N',
        'ChocalaPreprocessor' => 'Base/ChocalaPreprocessor',
        'ChocalaRouter' => 'Base/ChocalaRouter',
        'ChocalaService' => 'Base/ChocalaService',
        'ChocalaSingleService' => 'Base/ChocalaSingleService',
        'ChocalaVars' => 'Base/ChocalaVars',
        'Config' => 'Base/Config',
        'ConfigBase' => 'Base/ConfigBase',
        'Configs' => 'Base/Configs',
        'ForbiddenException' => 'Base/ForbiddenException',
        'FrontController' => 'Base/FrontController',
        'GlobalVars' => 'Base/GlobalVars',
        'HttpManager' => 'Base/HttpManager',
        'IChocalaErrorsManager' => 'Base/IChocalaErrorsManager',
        'IController' => 'Base/IController',
        'IFilter' => 'Base/IFilter',
        'IFrontController' => 'Base/IFrontController',
        'ISingleton' => 'Base/ISingleton',
        'ISingletonRegistry' => 'Base/ISingletonRegistry',
        'NotFoundException' => 'Base/NotFoundException',
        'Param' => 'Base/Param',
        'Params' => 'Base/Params',
        'SingletonRegistry' => 'Base/SingletonRegistry',
        'URI' => 'Base/URI',
        'ValidationException' => 'Base/ValidationException',
        'WebAliasController' => 'Base/WebAliasController',
        'WebController' => 'Base/WebController',

        'Convertible' => 'Behavior/Convertible',
        'Criteria' => 'Behavior/Criteria',
        'Logger' => 'Behavior/Logger',
        'Logging' => 'Behavior/Logging',
        'Relatable' => 'Behavior/Relatable',
        'SoftQuery' => 'Behavior/SoftQuery',
        'SoftDelete' => 'Behavior/SoftDelete',
        'SoftDeletion' => 'Behavior/SoftDeletion',
        'Validatable' => 'Behavior/Validatable',
        'ValidationFailed' => 'Behavior/ValidationFailed',

        'ChocalaAutoload' => 'Bin/ChocalaAutoload',
        'ChocalaInitVars' => 'Bin/ChocalaInitVars',
        'ConfigLoader' => 'Bin/ConfigLoader',

        'ClassMapHelper' => 'Generator/ClassMapHelper',
        'CodeGenerator' => 'Generator/CodeGenerator',

        'AjaxView' => 'Presentation/AjaxView',
        'BarView' => 'Presentation/BarView',
        'EmailView' => 'Presentation/EmailView',
        'IView' => 'Presentation/IView',
        'WebAliasView' => 'Presentation/WebAliasView',
        'WebView' => 'Presentation/WebView',

        'Cookie' => 'System/Cookie',
        'DBConfig' => 'System/DBConfig',
        'Delete' => 'System/Delete',
        'Flash' => 'System/Flash',
        'Get' => 'System/Get',
        'GlobalVar' => 'System/GlobalVar',
        'Post' => 'System/Post',
        'Put' => 'System/Put',
        'Req' => 'System/Req',
        'Session' => 'System/Session',

        'ContentType' => 'Util/ContentType',
        'Crypt' => 'Util/Crypt',
        'DateDiff' => 'Util/DateDiff',
        'DateUtil' => 'Util/DateUtil',
        'FilesHelper' => 'Util/FilesHelper',
        'Headers' => 'Util/Headers',
        'IImage' => 'Util/IImage',
        'Image' => 'Util/Image',
        'ImageMimeTypes' => 'Util/ImageMimeTypes',
        'Lessc' => 'Util/Lessc',
        'NumberUtil' => 'Util/NumberUtil',
        'PclZip' => 'Util/PclZip',
        'PHPMailer' => 'Util/PHPMailer',
        'SpecialStrings' => 'Util/SpecialStrings',
        'Validation' => 'Util/Validation',
        'ValidationHelper' => 'Util/ValidationHelper',
        'XMLParser' => 'Util/XMLParser',
*/
    );

    public static function baseDir()
    {
        return ROOT;
    }

    public static function appDir()
    {
        return ROOT;
    }

    /**
     * @param $_className
     * @return bool
     * @throws ChocalaException
     */
    public static function loading($_className)
    {
        if (strpos($_className, "Chocala\\") === 0) {
//            $namespace = explode("\\", $_className)[0];
            $classname = str_replace('\\', DIRECTORY_SEPARATOR, str_replace("Chocala\\", "", $_className));
            $filename = CHOCALA_DIR . $classname . ".php";
            if (file_exists($filename)) {
                include_once $filename;
            }
            return true;
        }

        if (strpos($_className, "App\\") === 0) {
//            $namespace = explode("\\", $_className)[0];
            $classname = str_replace('\\', DIRECTORY_SEPARATOR, str_replace("App\\", "", $_className));
            $filename = APP_DIR . $classname . ".php";
            if (file_exists($filename)) {
                include_once $filename;
            }
            return true;
        }

        if (isset(self::$autoloadMap[$_className])) {
            include_once CHOCALA_DIR . self::$autoloadMap[$_className] .
                Chocala::CLASS_EXTENSION;
            return true;
        }

        if (isset(self::$applicationMap[$_className])) {
            include_once APP_DIR . self::$applicationMap[$_className] .
                Chocala::CLASS_EXTENSION;
            return true;
        }

        if (file_exists(BASE_DIR . $_className . Chocala::CLASS_EXTENSION)) {
            include_once BASE_DIR . $_className . Chocala::CLASS_EXTENSION;
            return true;
        }

        $includePaths = explode(PATH_SEPARATOR, get_include_path());
        foreach ($includePaths as $includePath) {
            if (file_exists($includePath . $_className . Chocala::CLASS_EXTENSION)) {
                include_once $includePath . $_className . Chocala::CLASS_EXTENSION;
                return true;
            }
        }

        return false;

    }

}

spl_autoload_register('ChocalaAutoload::loading');