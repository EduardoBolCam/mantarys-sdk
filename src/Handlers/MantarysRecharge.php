<?php

namespace DevDizs\MantarysSdk\Handlers;

use DevDizs\MantarysSdk\Connection\SoapService;
use DevDizs\MantarysSdk\Exceptions\BadResponseException;
use DevDizs\MantarysSdk\Exceptions\TimeoutResponseException;

final class MantarysRecharge extends MantarysBase
{

    const RECHARGE_ACTION = 'Request_Transaction';
    const RECHARGE_VERIFY = 'check_transaction';

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
            'Folio_POS' => $folio
        ];

        $uri = 'http://ws_stage.cloud-services.mx:9192/service.asmx?WSDL';

        $client = new SoapService( $uri );

        $response = $client->call( $action, $data );

        if( empty( $response ) || !isset( $response[ 'Request_TransactionResult' ] ) ){
            throw new BadResponseException( 'No response available' );
        }

        // Response Confirmation must be 24 then we look throught 120 sec each 2 secs looking for a Confirmation !== 24
        // I must break in the 30 try
        $tries = 0;
        $responseFormated = $client->sanitizeResponse( $response['Request_TransactionResult'] );
        while( intval( $responseFormated['Confirmation'] ) === 24 ){
            if( $tries >= 20 ){
                throw new TimeoutResponseException( "Se intentó {$tries} veces y no cambió el status.", $folio );
                break;
            }
            $tries += 1;
            sleep( 2 );
            $responseFormated = $this->verifyRecharge( $folio );
        }

        $responseFormated['num_tries'] = $tries;

        return $responseFormated;
    }

    public function verifyRecharge( string $folio )
    {
        $uri = 'http://ws_stage.cloud-services.mx:9192/service.asmx?WSDL';

        $action = self::RECHARGE_VERIFY;

        $data = [
            'User'      => $this->user,
            'Folio_POS' => $folio
        ];

        $client = new SoapService( $uri );
        $response = $client->call( $action, $data );

        if( empty( $response ) || !isset( $response[ 'check_transactionResult' ] ) ){
            throw new BadResponseException( 'No response available' );
        }

        return $client->sanitizeResponse( $response['check_transactionResult'] );
    }

}