<?php

namespace DevDizs\MantarysSdk\Handlers;

class MantarysBase
{
    protected $user;
    protected $password;

    /**
     * @param string user User Provided by MANTARYS
     * @param string password Password provided by MANTARYS
     */
    protected function __construct( string $user, string $password )
    {
        $this->user     = $user;
        $this->password = $password;
    }

    /**
     * Mantarys required a unique alphanumeric to register the recharges.
     * @return string $folio
     */
    protected function buildFolio(): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Initialize an empty string to hold the generated folio
        $folio = '';

        // Loop to generate a random folio of 20 chars
        for ($i = 0; $i < 20; $i++) {
            // Select a random character from the allowed characters
            $folio .= $characters[ random_int( 0, strlen( $characters) - 1 ) ];
        }

        return $folio;
    }
}