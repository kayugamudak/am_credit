<?php

return [
    'components' => [
        'db' => [
            'class' => yii\db\Connection::class,
            'dsn' => 'pgsql:host=pgsql;dbname=americor_credit',
            'username' => 'root',
            'password' => 'secret999',
            'charset' => 'utf8',
            'enableSchemaCache' => true,
            'enableQueryCache' => true,
            'schemaCache' => 'apcuCache',
        ],
        'redis' => [
            'class' => \yii\redis\Connection::class,
            'hostname' => 'redis',
            'port' => 6379,
            'database' => 0,
        ],
    ],
];
