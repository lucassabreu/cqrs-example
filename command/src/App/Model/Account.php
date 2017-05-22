<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/*
 * @ORM\Entity
 * @ORM\Table(name="account")
 */
class Account
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /*
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /*
     * @ORM\Column(name="initial_balance", type="float", length=18, precision=2)
     */
    private $initialBalance;

    public function __contructor(string $name, float $initialBalance)
    {
        $this->name = $name;
        $this->initialBalance = $initialBalance;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getInitialBalance() : float
    {
        return $this->initialBalance;
    }
}
