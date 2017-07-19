<?php

namespace App\Action;

use App\Model\Account;
use App\Model\AccountCurrentBalance\AccountCurrentBalance;

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
            ->createQuery(
                "SELECT new " . AccountCurrentBalance::class . "(a.id, a.name, SUM(a.initialBalance) + SUM(m.value))
                    FROM " . Account::class . " a INNER JOIN a.movements m
                    WHERE a.id = :id
                    GROUP BY a.id, a.name"
            )
            ->setParameter('id', (int) $id)
            ->getOneOrNullResult();

        if (is_null($accountBalance)) {
            throw new Exception\ModelNotFoundException('Account ' . $id);
        }

        return new \Zend\Diactoros\Response\JsonResponse([
            'id' => $accountBalance->getId(),
            'name' => $accountBalance->getName(),
            'currentBalance' => $accountBalance->getCurrentBalance(),
        ]);
    }
}
