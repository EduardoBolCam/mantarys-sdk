<?php

namespace DevDizs\MantarysSdk\Connection;

use DevDizs\MantarysSdk\Exceptions\BadResponseException;
use DevDizs\MantarysSdk\Exceptions\ConnectionException;
use DevDizs\MantarysSdk\Exceptions\ErrorResponseException;
use nusoap_client;

class SoapService
{
    protected $client;

    public function __construct( string $uri )
    {
        $this->client = new nusoap_client( $uri, true );

        $error = $this->client->getError();
        if( $error ){
            throw new ConnectionException( 'Error building connection' );
        }
    }

    public function call( $methodName, $params = [] )
    {
        $result = $this->client->call( $methodName, $params, 'http://tempuri.org', 'http://www.ventamovil.com.mx/ws/Check_Balance' );

        if( $this->client->fault ){
            throw new BadResponseException();
        }else{
            $error = $this->client->getError();
            if( $error ){
                throw new ErrorResponseException( $error );
            }
        }

        return $result;
    }

    public function sanitizeResponse( string $text )
    {
        $xml = simplexml_load_string( $text, "SimpleXMLElement", LIBXML_NOCDATA );
        $json = json_encode( $xml );
        return json_decode( $json, true );
    }
}