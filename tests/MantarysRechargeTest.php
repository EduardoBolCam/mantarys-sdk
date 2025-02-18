<?php declare(strict_types=1);

use DevDizs\MantarysSdk\Exceptions\BadRechargeVerificationException;
use DevDizs\MantarysSdk\Exceptions\ConnectionException;
use DevDizs\MantarysSdk\Exceptions\TimeoutResponseException;
use DevDizs\MantarysSdk\MantarysResponseConstants;
use DevDizs\MantarysSdk\Handlers\MantarysRecharge;
use PHPUnit\Framework\TestCase;

final class MantarysRechargeTest extends TestCase
{
    private $validPhoneNumber = "2222222222";
    private $timeoutPhoneNumber = "5554444444";
    private $wait8secsPhone = "5551111111";
    private $notValidPhone = "4444444444";
    private $notValidRef = "5555555555";
    private $validCarrier = "203";
    private $validAmount = "100";

    // public function testMakeRecharge(): void
    // {
    //     $mantarysRecharge = new MantarysRecharge();
    //     $response = $mantarysRecharge->makeRecharge( $this->validCarrier, $this->validAmount, $this->validPhoneNumber );

    //     $this->assertIsArray( $response );
    //     $this->assertArrayHasKey( 'Folio_Carrier', $response );
    //     $this->assertArrayHasKey( 'Confirmation', $response );
    //     $this->assertArrayHasKey( 'num_tries', $response );
    //     $this->assertEquals( MantarysResponseConstants::SUCCESS_TRANSACTION, $response['Confirmation'] );
    // }

    // public function testMakeRechargeMoreThanOneTries()
    // {
    //     $mantarysRecharge = new MantarysRecharge();
    //     $response = $mantarysRecharge->makeRecharge( $this->validCarrier, $this->validAmount, $this->wait8secsPhone );

    //     $this->assertIsArray( $response );
    //     $this->assertArrayHasKey( 'Folio_Carrier', $response );
    //     $this->assertArrayHasKey( 'Confirmation', $response );
    //     $this->assertArrayHasKey( 'num_tries', $response );
    //     $this->assertEquals( MantarysResponseConstants::SUCCESS_TRANSACTION, $response['Confirmation'] );
    // }

    // public function testNotValidRef(): void
    // {
    //     $mantarysRecharge = new MantarysRecharge();
    //     $response = $mantarysRecharge->makeRecharge( $this->validCarrier, $this->validAmount, $this->notValidRef );

    //     $this->assertIsArray( $response );
    //     $this->assertArrayHasKey( 'Folio_Carrier', $response );
    //     $this->assertArrayHasKey( 'Confirmation', $response );
    //     $this->assertArrayHasKey( 'num_tries', $response );
    //     $this->assertEquals( MantarysResponseConstants::NOT_VALID_REF, $response['Confirmation'] );
    // }

    // public function testNotValidPhone(): void
    // {
    //     $mantarysRecharge = new MantarysRecharge();
    //     $response = $mantarysRecharge->makeRecharge( $this->validCarrier, $this->validAmount, $this->notValidPhone );

    //     $this->assertIsArray( $response );
    //     $this->assertArrayHasKey( 'Folio_Carrier', $response );
    //     $this->assertArrayHasKey( 'Confirmation', $response );
    //     $this->assertArrayHasKey( 'num_tries', $response );
    //     $this->assertEquals( MantarysResponseConstants::NOT_VALID_PHONE, $response['Confirmation'] );
    // }

    // public function testTimeoutRecharge(): void
    // {
    //     $this->expectException( TimeoutResponseException::class );
    //     $mantarysRecharge = new MantarysRecharge();
    //     $mantarysRecharge->makeRecharge( $this->validCarrier, $this->validAmount, $this->timeoutPhoneNumber );
    // }

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
            $response = $mantarysRecharge->makeRecharge( '204', '200', '5550000000' );
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

