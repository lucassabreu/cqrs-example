<?php

namespace App\EntityManager;

class EntityManagerFactory
{
    public function __invoke(\Interop\Container\ContainerInterface $container)
    {
        $doctrineConfig = $container->get('config')['doctrine'];

        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
            $doctrineConfig['paths'],
            $doctrineConfig['isDev'] ?? false
        );
        $entityManager = \Doctrine\ORM\EntityManager::create($doctrineConfig['connection'], $config);

        return $entityManager;
    }
}
