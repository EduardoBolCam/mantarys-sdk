<?php

namespace DevDizs\MantarysSdk\Exceptions;

use Exception;

final class BadResponseException extends Exception
{
    public function message()
    {
        return "Error getting response | MESSAGE: {$this->getMessage()} | LINE: {$this->getLine()} | FILE: {$this->getFile()}";
    }
}