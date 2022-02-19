<?php

use yii\db\Connection;
use yii\db\pgsql\Schema;

return [
    'postgres' => [
        'class'        => Connection::class,
        'dsn'          => 'pgsql:host=' . getenv('POSTGRES_HOST') .
            ';dbname=' . getenv('POSTGRES_DB'),
        'username'     => getenv('POSTGRES_USER'),
        'password'     => getenv('POSTGRES_PASSWORD'),
        'charset'      => 'utf8',
        'schemaMap'    => [
            'pgsql' => [
                'class'         => Schema::class,
                'defaultSchema' => getenv('POSTGRES_SCHEMA')
            ],
        ],
        'on afterOpen' => function ($event) {
            $event->sender->createCommand("SET search_path TO " . getenv('POSTGRES_SCHEMA') . ";")->execute();
            $event->sender->createCommand("SET TIME ZONE 'Europe/Moscow';")->execute();
        },
    ],
];
