<?php
/**
 * Description of DataSources
 *
 * @author ypra
 */
class DataSources
{

    static $development = [
        'datasource'=>  'system',
        'host'      =>  'localhost',
        'port'      =>  '3306',
        'dbname'    =>  'chocalaFW',
        'user'      =>  'root',
        'password'  =>  ''
    ];

    static $test = [
        'datasource'=>  'system',
        'host'      =>  'localhost',
        'port'      =>  '3306',
        'dbname'    =>  'base',
        'user'      =>  'root',
        'password'  =>  'root'
    ];

    static $testdocean = [
        'datasource'=>  'system',
        'host'      =>  'localhost',
        'port'      =>  '3306',
        'dbname'    =>  'base',
        'user'      =>  'root',
        'password'  =>  'root'
    ];

    static $production = [
        'datasource'=>  'system',
        'host'      =>  'localhost',
        'port'      =>  '3306',
        'dbname'    =>  'base',
        'user'      =>  'root',
        'password'  =>  'root'
    ];

    static $all = [
        'adapter'   =>  'mysql',
        'driver'    =>  'mysql',
        'charset'   =>  'UTF8',
    ];

}