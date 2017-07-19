<?php

namespace App\Action\Exception;

class MissingParametersException extends \ZendExpressiveHelpers\ErrorHandler\Exception\MiddlewareException
{
    public function __construct(array $expectedParameters, array $sentParameters)
    {
        $this->statusCode = 403;
        parent::__construct(sprintf(
            "There are missing parameters, expected parameters was: %s, sent was: %s",
            implode(', ', $expectedParameters),
            implode(', ', $sentParameters)
        ));
    }
}
