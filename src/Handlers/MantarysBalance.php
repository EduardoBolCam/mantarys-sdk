<?php

namespace DevDizs\MantarysSdk\Handlers;

use DevDizs\MantarysSdk\Connection\SoapService;

final class MantarysBalance
{
    const CHECK_BALANCE_ACTION = 'Check_balance';

    private $user;
    private $password;

    private $env = 'local';

    /**
     * @param string user User Provided by MANTARYS
     * @param string password Password provided by MANTARYS
     */
     public function __construct( string $user, string $password )
     {
         $this->user     = $user;
         $this->password = $password;

        //  $config = new Config();
        //  $this->env = $config->getConfig( 'env' );
     }

    public function getClientBalance()
    {
        $action = self::CHECK_BALANCE_ACTION;

        $data = [
            'User'  => $this->user,
            'Password' => $this->password,
        ];

        $uri = 'http://wsrecargas.payapp.mx/tmpagoventaws/status/soap.php?wsdl';

        if( $this->env !== 'production' ){
            // Only for tests
            $uri = 'http://ws_stage.cloud-services.mx:9192/service.asmx?WSDL';
        }

        $client = new SoapService( $uri );
        return $client->call( $action, $data );
    }
}