<?php

use yii\db\Connection;
use yii\db\pgsql\Schema;

return [
    'postgres' => [
        'class'        => Connection::class,
        'dsn'          => 'pgsql:host=' . env('POSTGRES_HOST') .
            ';dbname=' . env('POSTGRES_DB'),
        'username'     => env('POSTGRES_USER'),
        'password'     => env('POSTGRES_PASSWORD'),
        'charset'      => 'utf8',
        'schemaMap'    => [
            'pgsql' => [
                'class'         => Schema::class,
                'defaultSchema' => env('POSTGRES_SCHEMA')
            ],
        ],
        'on afterOpen' => function ($event) {
            $event->sender->createCommand("SET search_path TO " . env('POSTGRES_SCHEMA') . ";")->execute();
            $event->sender->createCommand("SET TIME ZONE 'Europe/Moscow';")->execute();
        },
    ],
];
