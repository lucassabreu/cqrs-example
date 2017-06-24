<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="account")
 */
class Account
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO");
     * @ORM\Column(name="id", type="integer")
     */
    private $id;
    /**
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;
    /**
     * @ORM\Column(name="initial_balance", type="decimal", precision=18, scale=2)
     */
    private $initialBalance;
    /**
     * @ORM\OneToMany(targetEntity="Movement", mappedBy="account")
     */
    private $movements;

    public function __construct(string $name, float $initialBalance = 0)
    {
        $this->name = $name;
        $this->initialBalance = $initialBalance;
        $this->movements = new \Doctrine\Common\Collections\ArrayCollection;
    }

    public function getId()
    {
        return $this->id;
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
