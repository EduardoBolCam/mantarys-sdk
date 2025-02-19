<?php

namespace DevDizs\MantarysSdk\Handlers;

use DevDizs\MantarysSdk\Connection\SoapService;
use DevDizs\MantarysSdk\Exceptions\BadRechargeVerificationException;
use DevDizs\MantarysSdk\Exceptions\BadResponseException;
use DevDizs\MantarysSdk\Exceptions\ErrorResponseException;
use DevDizs\MantarysSdk\Exceptions\TimeoutResponseException;

final class MantarysRecharge extends MantarysBase
{

    const RECHARGE_ACTION = 'Request_Transaction';
    const RECHARGE_VERIFY = 'check_transaction';

    /**
     * @param string user User Provided by MANTARYS
     * @param string password Password provided by MANTARYS
     */
    public function __construct( string $user = null, string $password = null )
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
        $tries = 0;
        $limit = 60;

        $action = self::RECHARGE_ACTION;

        $data = [
            'User'      => $this->user,
            'Password'  => $this->password,
            'Carrier'   => $carrier,
            'Price'     => $price,
            'Number'    => $dn,
            'Folio_POS' => $folio
        ];

        $client = new SoapService();

        $response = $client->call( $action, $data );

        if( empty( $response ) || !isset( $response[ 'Request_TransactionResult' ] ) ){
            throw new BadResponseException( 'No response available' );
        }

        // Response Confirmation must be 24 then we look throught 120 sec each 2 secs looking for a Confirmation !== 24
        $responseFormated = $client->sanitizeResponse( $response['Request_TransactionResult'] );
        while( intval( $responseFormated['Confirmation'] ) === 24 ){

            if( $tries === $limit ){
                throw new TimeoutResponseException( "Se intentó {$tries} veces y no cambió el status.", $folio );
                break;
            }

            try{
                $responseFormated = $this->verifyRecharge( $folio );
                $tries += 1;
            }catch( ErrorResponseException $e ){
                $tries += 1;
                if( $tries === $limit ){
                    throw new BadRechargeVerificationException( $e->getMessage(), $folio );
                    break;
                }
            }catch( BadResponseException $e ){
                throw new BadRechargeVerificationException( $e->getMessage(), $folio );
                break;
            }

            sleep( 2 );
        }

        $responseFormated['num_tries'] = $tries;

        return $responseFormated;
    }

    public function verifyRecharge( string $folio )
    {

        $action = self::RECHARGE_VERIFY;

        $data = [
            'User'      => $this->user,
            'Folio_POS' => $folio
        ];

        $client = new SoapService();
        $response = $client->call( $action, $data );

        if( empty( $response ) || !isset( $response[ 'check_transactionResult' ] ) ){
            throw new BadResponseException( 'No response available' );
        }

        return $client->sanitizeResponse( $response['check_transactionResult'] );
    }

}