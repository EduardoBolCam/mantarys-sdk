<?php

namespace DevDizs\MantarysSdk\Handlers;

use DevDizs\MantarysSdk\Connection\SoapService;
use DevDizs\MantarysSdk\Exceptions\BadResponseException;

final class MantarysRecharge extends MantarysBase
{

    const RECHARGE_ACTION = 'Request_Transaction';

    /**
     * @param string user User Provided by MANTARYS
     * @param string password Password provided by MANTARYS
     */
    public function __construct( string $user, string $password )
    {
        parent::__construct( $user, $password );
    }
    /**
     * Create, build and make the Mantarys recharge process
     * @param string $carrier Mantarys Carrier SKU 
     * @param string|double|int $price Mantarys product price
     * @param string $dn Phone number to recharge
     * 
     * @return array $response 
     */
    public function makeRecharge( string $carrier, $price, string $dn )
    {
        $folio = $this->buildFolio();

        $action = self::RECHARGE_ACTION;

        $data = [
            'User'      => $this->user,
            'Password'  => $this->password,
            'Carrier'   => $carrier,
            'Price'     => $price,
            'Number'    => $dn,
            'Folio_Pos' => $folio
        ];

        $uri = 'http://ws_stage.cloud-services.mx:9192/service.asmx?WSDL';

        $client = new SoapService( $uri, 30, 30 );

        $response = $client->call( $action, $data );

        if( empty( $response ) || !isset( $response[ 'Request_TransactionResult' ] ) ){
            throw new BadResponseException( 'No response available' );
        }

        return $client->sanitizeResponse( $response['Request_TransactionResult'] );
    }

}