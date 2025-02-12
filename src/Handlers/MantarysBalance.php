<?php

namespace DevDizs\MantarysSdk\Handlers;

use DevDizs\MantarysSdk\Connection\SoapService;
use DevDizs\MantarysSdk\Exceptions\BadResponseException;

final class MantarysBalance extends MantarysBase
{
    const CHECK_BALANCE_ACTION = 'Check_Balance';

    /**
     * @param string user User Provided by MANTARYS
     * @param string password Password provided by MANTARYS
     */
    public function __construct( string $user = null, string $password = null )
    {
        parent::__construct( $user, $password );
    }

    /**
     * Get client balance
     * @return 
     */
    public function getClientBalance()
    {
        $action = self::CHECK_BALANCE_ACTION;

        $data = [
            'User'  => $this->user,
            'Password' => $this->password,
        ];

        $client = new SoapService();

        $response = $client->call( $action, $data );

        if( empty( $response ) || !isset( $response[ 'Check_BalanceResult' ] ) ){
            throw new BadResponseException( 'No response available' );
        }

        return $client->sanitizeResponse( $response['Check_BalanceResult'] );
    }
}