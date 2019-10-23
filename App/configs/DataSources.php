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
        'host'      =>  '127.0.0.1',
        'port'      =>  '3306',
        'dbname'    =>  'empleos.click',
        'user'      =>  'raul',
        'password'  =>  'inventic@$'
    );

    static $test = array(
        'datasource'=>  'jobsterin',
        'host'      =>  'mysql.empleos.click',
        'port'      =>  '3306',
        'dbname'    =>  'jobsterin',
        'user'      =>  'jobsterin',
        'password'  =>  'Jobsterin.2017.pasS'
    );

    static $testDOcean = array(
        'datasource'=>  'empleos_test',
        'host'      =>  '127.0.0.1',
        'port'      =>  '3306',
        'dbname'    =>  'empleos_test',
        'user'      =>  'admin',
        'password'  =>  'AppTics2015@#$'
    );

    static $production = array(
        'datasource'=>  'jobsterin',
        'host'      =>  'mysql.empleos.click',
        'port'      =>  '3306',
        'dbname'    =>  'jobsterin',
        'user'      =>  'jobsterin',
        'password'  =>  'Jobsterin.2017.pasS'
    );

    static $all = array(
        'adapter'   =>  'mysql',
        'driver'    =>  'mysql',
        'charset'   =>  'UTF8',
    );

}