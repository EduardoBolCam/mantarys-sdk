<?php

namespace DevDizs\MantarysSdk\Exceptions;

use Exception;

final class TimeoutResponseException extends Exception
{
    private $folio;
    public function __construct( $message, $folio)
    {
        parent::__construct( $message );
        $this->folio = $folio;
    }

    public function message()
    {
        return "Error Response | MESSAGE: {$this->getMessage()} | LINE: {$this->getLine()} | FILE: {$this->getFile()}";
    }

    public function getFolio()
    {
        return $this->folio;
    }
}