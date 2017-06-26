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
    const DESCREASE = 0;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO");
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

    public static function createIncreaseMovementWithAccountDateAndAmount(Account $account, \DateTime $when, float $amount)
    {
        if ($amount <= 0) {
            throw Movement\MovementException::amountShouldBePositive($amount);
        }

        return new self($account, $amount, $when);
    }

    public function __construct(Account $account, float $value, DateTime $date = null)
    {
        $this->account = $account;
        $this->setValue($value);
        $this->date = $date ?: new DateTime;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setValue(float $value) : self
    {
        if ($value === 0) {
            throw new \InvalidArgumentException('Movements value must not be zero !');
        }
        $this->value = $value;
        $this->type = $value > 0 ? self::INCREASE : self::DECREASE;
        return $this;
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

    public function setDate(DateTime $date) : self
    {
        $this->date = $date;
        return $this;
    }

    public function getDate() : DateTime
    {
        return $this->date;
    }
}
