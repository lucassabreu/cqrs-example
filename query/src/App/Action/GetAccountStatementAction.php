<?php

namespace App\Action;

use App\Model\Account;
use App\Model\AccountStatement\AccountStatement;

class GetAccountStatementAction implements \Interop\Http\ServerMiddleware\MiddlewareInterface
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
        $query = $request->getQueryParams();
        if (isset($query['id'], $query['start'], $query['end']) === false) {
            throw new Exception\MissingParametersException(
                [ 'id', 'start', 'end' ],
                array_keys($query)
            );
        }

        $id = $query['id'];
        $startDate = \DateTime::createFromFormat('!Y-m-d', $query['start']);
        $endDate = \DateTime::createFromFormat('!Y-m-d', $query['end']);

        var_dump($startDate);
        die;

        $accountStatement = $this->entityManager
            ->createQuery(
                "SELECT
                    new " . AccountStatement::class . "(
                        a.id,
                        a.name,
                        SUM(a.initialBalance) + SUM(m.value)
                    )
                    FROM " . Account::class . " a INNER JOIN a.movements m
                    WHERE a.id = :id
                      AND m.date < :startDate"
            )
            ->setParameter('id', (int) $id)
            ->getOneOrNullResult();

        if (is_null($account)) {
            throw new Exception\ModelNotFoundException('Account ' . $id);
        }

        return new \Zend\Diactoros\Response\JsonResponse($response);
    }
}
