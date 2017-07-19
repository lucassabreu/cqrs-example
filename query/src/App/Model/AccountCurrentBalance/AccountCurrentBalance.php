<?php

namespace App\Model\AccountCurrentBalance;

use Doctrine\ORM\Mapping as ORM;

class AccountCurrentBalance
{
    private $id;
    private $name;
    private $currentBalance;

    public function __construct(int $id, string $name, float $currentBalance)
    {
        $this->id = $id;
        $this->name = $name;
        $this->currentBalance = $currentBalance;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getCurrentBalance() : float
    {
        return $this->currentBalance;
    }
}
