<?php
/**
 * Description of DBConfig
 *
 * @author ypra
 */
class DBConfig
{

    public static function envConfigs($env)
    {
        switch($env){
            case 'production':
                $conf = DataSources::$production;
                break;
            case 'test':
                $conf = DataSources::$test;
                break;
            case 'development':
            default :
                $conf = DataSources::$development;
                break;
        }
        return array_merge(DataSources::$all, $conf);
    }

    public static function configs()
    {
        $conf = self::envConfigs(Configs::value('app.run.environment'));
        $conf['driver'] = strtolower($conf['driver']!=''? $conf['driver']:
            $conf['adapter']);
        return [
            'dsn' => self::dsn($conf),
            'user' => $conf['user'],
            'password' => $conf['password'],
            'settings' => [
                'charset' => 'utf8',
                'queries' => [

                ],
            ],
            'classname' => 'Propel\\Runtime\\Connection\\DebugPDO',
            'generator_version' => '2.0',
        ];
    }

    public static function dsn($conf)
    {
        $dsn = $conf['driver'].':';
        switch ($conf['adapter']){
            case 'mysql':
                $dsn.= 'host='.$conf['host'].';dbname='.$conf['dbname'].
                    ';charset=UTF8';
                break;
            case 'pgsql':
                $dsn.= 'host='.$conf['host'].';port='.$conf['port'].
                    ';dbname='.$conf['dbname'].';user='.$conf['user'].
                    ';password='.$conf['password'];
                break;
            case 'sqlite':
                $dsn.= ':'.($conf['host']!=''? $conf['host']: ':memory:');
                break;
            case 'mssql':
                if($conf['driver'] == 'sqlsrv'){
                    $dsn.= 'server='.$conf['host'].','.$conf['port'].
                            ';Database='.$conf['dbname'];
                }elseif($conf['driver'] == 'sybase'){
                    $dsn.= 'host='.$conf['host'].':'.$conf['port'].
                            ';dbname='.$conf['dbname'];
                }else{
                    $dsn = 'mssql:host='.$conf['host'].','.$conf['port'].
                            ';dbname='.$conf['dbname'];
                }
                break;
            case 'oracle':
            case 'oci':
                $dsn = '//'.$conf['host'].':'.$conf['port'].'/'.$conf['dbname'];
                break;
            default :
                throw new ChocalaException('Unknow database adapter');
                break;
        }
        return $dsn;
    }

    public static function init()
    {
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $serviceContainer->checkVersion('2.0.0-dev');
        $serviceContainer->setAdapterClass('default', 'mysql');
        $manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
        $manager->setConfiguration(self::configs());
        $manager->setName('default');
        $serviceContainer->setConnectionManager('default', $manager);
        $serviceContainer->setDefaultDatasource('default');
    }

}