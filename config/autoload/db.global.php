<?php
/**
 * STRATO DBConfig
 */
$dbParamsMySQL = array(
    'database' => 'erpapi',
    'username' => 'allapowdb',
    'password' => 'rellaY666a',
    'hostname' => 'localhost',
);

return array(
    'service_manager' => array(
//        'factories' => array(
//            'Zend\Db\Adapter\Adapter' => function ($sm) use ($dbParamsGfmstaff) {
//                return new Zend\Db\Adapter\Adapter(array(
//                    'driver' => 'Pdo_Mysql', // Pdo_Mysql, pdo auch OK
//                    'dsn' => 'mysql:dbname=' . $dbParamsGlobal['database'] . ';host=' . $dbParamsGlobal['hostname'] . ';charset=utf8',
//                    'database' => $dbParamsGlobal['database'],
//                    'username' => $dbParamsGlobal['username'],
//                    'password' => $dbParamsGlobal['password'],
//                    'hostname' => $dbParamsGlobal['hostname'],
//                ));
//            },
//        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Db\Adapter\AdapterAbstractServiceFactory',
        ),
    ),
    'db' => array(
        // for primary db adapter that called
        // by $sm->get('Zend\Db\Adapter\Adapter')
//        'username' => $dbParamsGlobal['username'],
//        'password' => $dbParamsGlobal['password'],
//        'driver' => 'Pdo',
//        'dsn' => 'mysql:dbname=' . $dbParamsGlobal['database'] . ';host=' . $dbParamsGlobal['hostname'] . ';charset=utf8',
//        'driver_options' => array(
//            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
//        ),
        'adapters' => array(
            'dbGodatas' => array(
                'username' => $dbParamsMySQL['username'],
                'password' => $dbParamsMySQL['password'],
                'driver' => 'Pdo_Mysql',
                'dsn' => 'mysql:dbname=' . $dbParamsMySQL['database'] . ';host=' . $dbParamsMySQL['hostname'] . ';charset=utf8',
                'driver_options' => array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
                ),
            ),
//            'dbSecond' => array(
//                'username' => $dbParamsSecond['username'],
//                'password' => $dbParamsSecond['password'],
//                'driver' => 'Pdo_Mysql',
//                'dsn' => 'mysql:dbname=' . $dbParamsSecond['database'] . ';host=' . $dbParamsSecond['hostname'] . ';charset=utf8',
//                'driver_options' => array(
//                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
//                ),
//            ),
        ),
    ),
);