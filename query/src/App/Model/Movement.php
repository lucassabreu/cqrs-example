<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="movement")
 */
class Movement
{
    const INCREASE = 1;
    const DECREASE = 0;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="Account")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     */
    private $account;
    /**
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    /**
     * @ORM\Column(name="type", type="smallint", precision=1)
     */
    private $type;
    /**
     * @ORM\Column(name="value", type="decimal", precision=18, scale=2)
     */
    private $value;

    private function __construct()
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getValue() : float
    {
        return $value;
    }

    public function getType() : int
    {
        return $this->type;
    }

    public function getAccount() : Account
    {
        return $this->account;
    }

    public function getDate() : DateTime
    {
        return $this->date;
    }
}
