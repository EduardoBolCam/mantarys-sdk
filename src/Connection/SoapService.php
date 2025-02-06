<?php

namespace DevDizs\MantarysSdk\Connection;

use DevDizs\MantarysSdk\Exceptions\BadResponseException;
use DevDizs\MantarysSdk\Exceptions\ConnectionException;
use DevDizs\MantarysSdk\Exceptions\ErrorResponseException;
use DevDizs\MantarysSdk\Exceptions\TimeoutResponseException;
use nusoap_client;

class SoapService
{
    protected $client;

    public function __construct( string $uri, int $timeout = 0, int $response_timeout = 30 )
    {
        $this->client = new nusoap_client( $uri, true );
        $this->client->timeout = $timeout;
        $this->client->response_timeout = $response_timeout;

        $error = $this->client->getError();
        if( $error ){
            throw new ConnectionException( 'Error building connection' );
        }
    }

    public function call( $methodName, $params = [] )
    {
        $params = ['jrquest' => json_encode( $params )];
        $result = $this->client->call( $methodName, $params );

        if( $this->client->fault ){
            throw new BadResponseException();
        }else{
            $error = $this->client->getError();
            if( $error ){
                if( strpos( $error, 'timeout' ) !== false ){
                    throw new TimeoutResponseException( $error, $params['Folio_Pos'] ?? '0000' );
                }
                throw new ErrorResponseException( $error );
            }
        }
        return $result;
    }

    public function sanitizeResponse( $value )
    {
        return json_decode( $value, true );
    }
}