<?php

namespace App\Action;

use App\Model;

class AccountDecreaseAction implements \Interop\Http\ServerMiddleware\MiddlewareInterface
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

        if (!isset($data['account'], $data['amount'], $data['date'])) {
            throw Model\Movement\MovementException::requiredValuesNotInformed(array_keys($data));
        }

        if (!is_int($data['account'])) {
            throw Model\Movement\MovementException::mustInformAccountId();
        }

        $account = $this->entityManager->getRepository(Model\Account::class)
            ->findOneById((int) $data['account']);

        if (is_null($account)) {
            throw Model\Movement\MovementException::accountDoesNotExists($data['account']);
        }

        $movement = Model\Movement::createDecreaseMovementWithAccountDateAndAmount(
            $account,
            new \DateTime($data['date']),
            (float) $data['amount']
        );
        $this->entityManager->persist($movement);
        $this->entityManager->flush();

        return new \Zend\Diactoros\Response\JsonResponse([ 'id' => $movement->getId() ]);
    }
}
