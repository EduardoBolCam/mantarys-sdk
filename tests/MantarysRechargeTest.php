<?php declare(strict_types=1);

use DevDizs\MantarysSdk\Exceptions\TimeoutResponseException;
use DevDizs\MantarysSdk\MantarysResponseConstants;
use DevDizs\MantarysSdk\Handlers\MantarysRecharge;
use PHPUnit\Framework\TestCase;

final class MantarysRecargeTest extends TestCase
{
    private $validUserTest     = '6144135400';
    private $validPasswordTest = 'Prueba$$';

    private $validPhoneNumber = "2222222222";
    private $timeoutPhoneNumber = "5554444444";
    private $wait8secsPhone = "5551111111";
    private $notValidPhone = "4444444444";
    private $notValidRef = "5555555555";
    private $validCarrier = "203";
    private $validAmount = "100";

    public function testMakeRecharge(): void
    {
        $mantarysRecharge = new MantarysRecharge( $this->validUserTest, $this->validPasswordTest );
        $response = $mantarysRecharge->makeRecharge( $this->validCarrier, $this->validAmount, $this->validPhoneNumber );

        $this->assertIsArray( $response );
        $this->assertArrayHasKey( 'Folio_Carrier', $response );
        $this->assertArrayHasKey( 'Confirmation', $response );
        $this->assertArrayHasKey( 'num_tries', $response );
        $this->assertEquals( MantarysResponseConstants::SUCCESS_TRANSACTION, $response['Confirmation'] );
        $this->assertEquals( 1, $response['num_tries'] );
    }

    public function testMakeRechargeMoreThanOneTries()
    {
        $mantarysRecharge = new MantarysRecharge( $this->validUserTest, $this->validPasswordTest );
        $response = $mantarysRecharge->makeRecharge( $this->validCarrier, $this->validAmount, $this->wait8secsPhone );

        $this->assertIsArray( $response );
        $this->assertArrayHasKey( 'Folio_Carrier', $response );
        $this->assertArrayHasKey( 'Confirmation', $response );
        $this->assertArrayHasKey( 'num_tries', $response );
        $this->assertEquals( MantarysResponseConstants::SUCCESS_TRANSACTION, $response['Confirmation'] );
        $this->assertEquals( 4, $response['num_tries'] );
    }

    public function testNotValidRef(): void
    {
        $mantarysRecharge = new MantarysRecharge( $this->validUserTest, $this->validPasswordTest );
        $response = $mantarysRecharge->makeRecharge( $this->validCarrier, $this->validAmount, $this->notValidRef );

        $this->assertIsArray( $response );
        $this->assertArrayHasKey( 'Folio_Carrier', $response );
        $this->assertArrayHasKey( 'Confirmation', $response );
        $this->assertArrayHasKey( 'num_tries', $response );
        $this->assertEquals( MantarysResponseConstants::NOT_VALID_REF, $response['Confirmation'] );
        $this->assertEquals( 1, $response['num_tries'] );
    }

    public function testNotValidPhone(): void
    {
        $mantarysRecharge = new MantarysRecharge( $this->validUserTest, $this->validPasswordTest );
        $response = $mantarysRecharge->makeRecharge( $this->validCarrier, $this->validAmount, $this->notValidPhone );

        $this->assertIsArray( $response );
        $this->assertArrayHasKey( 'Folio_Carrier', $response );
        $this->assertArrayHasKey( 'Confirmation', $response );
        $this->assertArrayHasKey( 'num_tries', $response );
        $this->assertEquals( MantarysResponseConstants::NOT_VALID_PHONE, $response['Confirmation'] );
        $this->assertEquals( 1, $response['num_tries'] );
    }

    public function testTimeoutRecharge(): void
    {
        $this->expectException( TimeoutResponseException::class );
        $mantarysRecharge = new MantarysRecharge( $this->validUserTest, $this->validPasswordTest );
        $mantarysRecharge->makeRecharge( $this->validCarrier, $this->validAmount, $this->timeoutPhoneNumber );
    }
}

