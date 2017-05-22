<?php

namespace App\Container;

class EntityManagerFactory
{
    public function __invoke(\Interop\Container\ContainerInterface $container)
    {
        $config = $container->get('config')['doctrine'];

        $doctrine = new \Doctrine\ORM\Configuration;
        $doctrine->setProxyDir(
            $config['orm']['proxy_dir'] ?? 'data/cache/doctrine/proxy'
        );
        $doctrine->setProxyNamespace(
            $config['orm']['proxy_namespace'] ?? 'EntityProxy'
        );
        $doctrine->setAutoGenerateProxyClasses(
            $config['orm']['auto_generate_proxy_classes'] ?? false
        );
        if ($config['orm']['underscore_naming_strategy']) {
            $doctrine->setNamingStrategy(new \Doctrine\ORM\Mapping\UnderscoreNamingStrategy);
        }

        \Doctrine\Common\Annotations\AnnotationRegistry::registerFile(
            'vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php'
        );
        $driver = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver(
            new \Doctrine\Common\Annotations\AnnotationReader,
            $config['annotation']['metadata']
        );
        $doctrine->setMetadataDriverImpl($driver);

        // $cache = $container->get(\Doctrine\Common\Cache\Cache::class);
        // $doctrine->setQueryCacheImpl($cache);
        // $doctrine->setResultCacheImpl($cache);
        // $doctrine->setMetadataCacheImpl($cache);

        $entityManager = \Doctrine\ORM\EntityManager::create(
            $config['connection'],
            $doctrine
        );

        return $entityManager;
    }
}
