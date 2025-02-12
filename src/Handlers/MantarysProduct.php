<?php

namespace DevDizs\MantarysSdk\Handlers;

use DevDizs\MantarysSdk\Connection\SoapService;
use DevDizs\MantarysSdk\Exceptions\BadResponseException;

final class MantarysProduct extends MantarysBase
{
    const FETCH_PRODUCTS = 'pos_prices_products';

    /**
     * @param string user User Provided by MANTARYS
     * @param string password Password provided by MANTARYS
     */
    public function __construct( string $user = null, string $password = null )
    {
        parent::__construct( $user, $password );
    }

    public function getProducts()
    {
        $action = self::FETCH_PRODUCTS;

        $data = [
            'User'    => $this->user,
            'Password'=> $this->password,
        ];

        $client = new SoapService();

        $response = $client->call( $action, $data );

        if( empty( $response ) || !isset( $response[ 'pos_prices_productsResult' ] ) ){
            throw new BadResponseException( 'No response available' );
        }

        return $client->sanitizeResponse( $response[ 'pos_prices_productsResult' ] );
    }
}