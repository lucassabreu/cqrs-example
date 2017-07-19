<?php

namespace App\Action\Exception;

class ModelNotFoundException extends \ZendExpressiveHelpers\ErrorHandler\Exception\MiddlewareException
{
    public function __construct($model)
    {
        $this->statusCode = 404;
        parent::__construct(sprintf("%s not found !", $model));
    }
}
