<?php

namespace App\Action;

class EntityManagerActionFactory
{
    public function __invoke(\Interop\Container\ContainerInterface $container, $requestedAction)
    {
        return new $requestedAction(
            $container->get(\Doctrine\ORM\EntityManager::class)
        );
    }
}
