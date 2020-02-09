<?php
/**
 * Description of DataSources
 *
 * @author ypra
 */
class DataSources
{

    static $development = array(
        'datasource'=>  'system',
        'host'      =>  'localhost',
        'port'      =>  '3307',
        'dbname'    =>  'base',
        'user'      =>  'root',
        'password'  =>  'root'
    );

    static $test = array(
        'datasource'=>  'system',
        'host'      =>  'localhost',
        'port'      =>  '3306',
        'dbname'    =>  'base',
        'user'      =>  'root',
        'password'  =>  'root'
    );

    static $testdocean = array(
        'datasource'=>  'system',
        'host'      =>  'localhost',
        'port'      =>  '3306',
        'dbname'    =>  'base',
        'user'      =>  'root',
        'password'  =>  'root'
    );

    static $production = array(
        'datasource'=>  'system',
        'host'      =>  'localhost',
        'port'      =>  '3306',
        'dbname'    =>  'base',
        'user'      =>  'root',
        'password'  =>  'root'
    );

    static $all = array(
        'adapter'   =>  'mysql',
        'driver'    =>  'mysql',
        'charset'   =>  'UTF8',
    );

}