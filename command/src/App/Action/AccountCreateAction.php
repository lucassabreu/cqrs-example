<?php

namespace App\Action;

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
            throw \App\Model\Account\AccountException::nameShouldNotBeEmpty();
        }

        if (!isset($data['initialBalance'])) {
            $data['initialBalance'] = 0;
        }

        $account = new \App\Model\Account($data['name'], $data['initialBalance']);
        $this->entityManager->persist($account);
        $this->entityManager->flush();

        return new \Zend\Diactoros\Response\JsonResponse([ 'id' => $account->getId()]);
    }
}
