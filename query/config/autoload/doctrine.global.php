<?php

return [
    'dependencies' => [
        'factories' => [
            \Doctrine\ORM\EntityManager::class => \App\Container\EntityManagerFactory::class,
            \Doctrine\DBAL\Migrations\Configuration\Configuration::class => \App\Container\DoctrineMigrationsFactory::class,
        ],
    ],

    'doctrine' => [
        'orm' => [
            'auto_generate_proxy_classes' => true,
            'proxy_dir' => 'data/cache/doctrine/proxy',
            'proxy_namespace' => 'EntityProxy',
            'underscore_naming_strategy' => true,
        ],
        'connection' => [
            'driver' => 'pdo_mysql',
            'host' => 'db',
            'port' => '3306',
            'dbname' => 'cqrs',
            'user' => 'cqrs',
            'password' => 'cqrs',
            'charset'  => 'UTF8',
        ],
        'annotation' => [
            'metadata' => [
                'src/App/Model'
            ],
        ],
        'migrations' => [
            'directory' => 'src/App/Migrations',
            'namespace' => 'App\Migrations',
        ],
    ],
];
