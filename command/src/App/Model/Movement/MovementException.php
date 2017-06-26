<?php

namespace App\Model\Movement;

class MovementException extends \App\Core\Exception\MiddlewareException
{
    public static function requiredValuesNotInformed(array $informedKeys) : self
    {
        return new self(sprintf(
            "You must inform the Account, Date and the Amount to increase a Account ! The values informed was: %s.",
            implode($informedKeys, ", ")
        ));
    }

    public static function accountMustExists($id) : self
    {
        return new self(sprintf(
            "The Account %d does not exists !",
            $id
        ));
    }

    public static function mustInformAccountId() : self
    {
        return new self("You must inform the Account Id number !");
    }

    public static function amountShouldBePositive(float $amount) : self
    {
        return new self(sprintf(
            "The amount should be a positive non-zero ! Amount informed was %.2f.",
            $amount
        ));
    }
}
