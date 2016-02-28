<?php
/**
 * STRATO DBConfig
 */
$dbParamsMySQL = array(
    'database' => '',
    'username' => '',
    'password' => '',
    'hostname' => 'localhost',
);

return array(
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => function ($sm) use ($dbParamsMySQL) {
                return new Zend\Db\Adapter\Adapter(array(
                    'driver' => 'Pdo_Mysql', // pdo auch OK
                    'dsn' => 'mysql:dbname=' . $dbParamsMySQL['database'] . ';host=' . $dbParamsMySQL['hostname'] . ';charset=utf8',
                    'database' => $dbParamsMySQL['database'],
                    'username' => $dbParamsMySQL['username'],
                    'password' => $dbParamsMySQL['password'],
                    'hostname' => $dbParamsMySQL['hostname'],
                ));
            },
        ),
    ),
);