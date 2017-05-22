<?php

namespace App\Container;

class DoctrineMigrationsFactory {

    public function __invoke(\Interop\Container\ContainerInterface $container)
    {
        $config = $container->get('config')['doctrine']['migrations'] ?? [];
        $em = $container->get(\Doctrine\ORM\EntityManager::class);

        $migrationsConfig = new \Doctrine\DBAL\Migrations\Configuration\Configuration(
            $em->getConnection()
        );
        $migrationsConfig->setMigrationsTableName($config['table'] ?? 'migrations_version');
        $migrationsConfig->setMigrationsDirectory($config['directory'] ?? 'data/Migrations');
        $migrationsConfig->setMigrationsNamespace($config['namespace'] ?? 'DoctrineMigrations');
        $migrationsConfig->registerMigrationsFromDirectory($config['directory'] ?? 'data/Migrations');

        return $migrationsConfig;
    }
}
