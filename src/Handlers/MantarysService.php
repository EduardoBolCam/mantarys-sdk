<?php

namespace DevDizs\MantarysSdk\Handlers;

use DevDizs\MantarysSdk\Connection\SoapService;
use DevDizs\MantarysSdk\Exceptions\BadResponseException;

final class MantarysService extends MantarysBase
{
    const SERVICE_PENDING_AMOUNT = 'check_service_pending_amount';

    public function __construct()
    {
        //
    }

    public function getServicePendingAmount( string $product, string $ref )
    {
        $action = self::SERVICE_PENDING_AMOUNT;

        $data = [
            'id_operadora' => $product,
            'referencia'   => $ref,
        ];

        $client = new SoapService();

        $response = $client->call( $action, $data );

        if( empty( $response ) || !isset( $response[ 'check_service_pending_amountResult' ] ) ){
            throw new BadResponseException( 'No response available' );
        }

        return $client->sanitizeResponse( $response[ 'check_service_pending_amountResult' ] );
    }
}
