<?php

namespace App\Core\Exception;

class MiddlewareException extends \RuntimeException
{
    protected $statusCode = 403;
    protected $additionalData = [];

    public function getStatusCode() : int
    {
        return $this->statusCode;
    }

    public function getAdditionalData() : array
    {
        return $this->additionalData;
    }
}
