<?php

namespace App\Action;

class GetAccountCurrentBalanceAction implements \Interop\Http\ServerMiddleware\MiddlewareInterface
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
        $id = $request->getAttribute('id');
        $accountBalance = $this->entityManager
            ->getRepository(\App\Model\AccountCurrentBalance\AccountCurrentBalance::class)
            ->findOneById((int) $id);

        return new \Zend\Diactoros\Response\JsonResponse([
            'id' => $accountBalance->getId(),
            'name' => $accountBalance->getName(),
            'currentBalance' => $accountBalance->getCurrentBalance(),
        ]);
    }
}
