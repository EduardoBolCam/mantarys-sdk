<?php

namespace DevDizs\MantarysSdk\Exceptions;

use Exception;

final class BadRechargeVerificationException extends Exception
{
    private $folio;
    public function __construct( $message, $folio)
    {
        parent::__construct( $message );
        $this->folio = $folio;
    }

    public function getFolio()
    {
        return $this->folio;
    }
}