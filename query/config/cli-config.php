<?php

$container = require __DIR__ . '/container.php';

$runner = \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet(
    $container->get(\Doctrine\ORM\EntityManager::class)
);

$em = $container->get(\Doctrine\ORM\EntityManager::class);
$migrations = $container->get(\Doctrine\DBAL\Migrations\Configuration\Configuration::class);

return new \Symfony\Component\Console\Helper\HelperSet([
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em),
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'configuration' => new \Doctrine\DBAL\Migrations\Tools\Console\Helper\ConfigurationHelper(
        $em->getConnection(),
        $migrations
    ),
]);

