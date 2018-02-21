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
        'dbname'    =>  'jobs',
        'user'      =>  'root',
        'password'  =>  ''
    );
    
    static $test = array(
        'datasource'=>  'jobsterin',
        'host'      =>  'mysql.empleos.click',
        'port'      =>  '3306',
        'dbname'    =>  'jobsterin',
        'user'      =>  'jobsterin',
        'password'  =>  'Jobsterin.2017.pasS'
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