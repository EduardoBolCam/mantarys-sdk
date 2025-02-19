<?php

use DevDizs\MantarysSdk\Exceptions\BadRechargeVerificationException;
use DevDizs\MantarysSdk\Exceptions\ConnectionException;
use DevDizs\MantarysSdk\Exceptions\TimeoutResponseException;
use DevDizs\MantarysSdk\Handlers\MantarysRecharge;
use PHPUnit\Framework\TestCase;

class MantarysCertTest extends TestCase
{
    public function testGeneral()
    {
        date_default_timezone_set('America/Mexico_City');

        echo("\n");
        echo( '__________STARTING TEST__________' );
        echo("\n");
        $startDateTime = date( 'Y-M-d H:i:s' );
        $start = strtotime( $startDateTime );
        echo( 'At: '. $startDateTime);
        echo("\n");

        try{
            $mantarysRecharge = new MantarysRecharge();
            $response = $mantarysRecharge->makeRecharge( '204', '100', '5554444444' );
            // $response = $mantarysRecharge->verifyRecharge( '10008QuUJyTx8XVJ00VcYaGUy' );
            echo print_r($response, true);
        }catch( TimeoutResponseException $te ){
            echo $te->message();
            echo("\n");
            echo 'Folio: ' . $te->getFolio();
        }catch( BadRechargeVerificationException $br ){
            echo $br->getMessage();
            echo("\n");
            echo 'Folio: ' . $br->getFolio();
        }catch( ConnectionException $ce ){
            echo $ce->getMessage();
            echo("\n");
        }

        echo("\n");
        $finishedDateTime = date( 'Y-M-d H:i:s' );
        $finished = strtotime( $finishedDateTime );
        echo( '__________FINISHED TEST__________' );
        echo("\n");
        echo( 'At: '. $finishedDateTime);
        echo("\n");
        echo( 'Total in line: '. ( $finished - $start ));
        echo("\n");

        $this->assertTrue(true);
    }
}