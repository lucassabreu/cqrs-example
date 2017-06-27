<?php

namespace App\Model\Account;

class AccountException extends \ZendExpressiveHelpers\ErrorHandler\Exception\MiddlewareException
{
    public static function initialBalanceShouldNotBeNegative(float $initialBalance) : self
    {
        return new self(sprintf(
            "The value %.2f is invalid as Initial Balance for the Account, it should be zero or positive !",
            $initialBalance
        ));
    }

    public static function nameShouldNotBeEmpty() : self
    {
        return new self("The name should not be empty !");
    }
}
