<?php

namespace App\Action;

use Zend\Diactoros\Response\JsonResponse;

class AccountCreateAction implements \Interop\Http\ServerMiddleware\MiddlewareInterface
{
    private $entityManager;

    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function process(
        \Psr\Http\Message\ServerRequestInterface $request,
        \Interop\Http\ServerMiddleware\DelegateInterface $delegate
    ) {
        $data = $request->getParsedBody();

        if (!isset($data['name'])) {
            throw new \Exception("You must inform a name to create a Account !");
        }

        return new JsonResponse($data);
    }
}
