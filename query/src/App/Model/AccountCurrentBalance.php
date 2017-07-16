<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="account_current_balance")
 */
class AccountCurrentBalance
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     */
    private $id;
    /**
     * @ORM\Column(name="name", type="string")
     */
    private $name;
    /**
     * @ORM\Column(name="current_balance", type="decimal", precision=18, scale=2)
     */
    private $currentBalance;

    private function __construct()
    {
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
