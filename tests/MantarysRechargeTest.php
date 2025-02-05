<?php declare(strict_types=1);

use DevDizs\MantarysSdk\ResponseContants;
use DevDizs\MantarysSdk\Handlers\MantarysRecharge;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\Invoker\TimeoutException;

final class MantarysRecargeTest extends TestCase
{
    private $validUserTest     = '6144135400';
    private $validPasswordTest = 'Prueba$$';

    private $validPhoneNumber = '2222222222';
    private $timeoutPhoneNumber = '5558888888';
    private $validCarrier = '01';
    private $valideAmount = 10;

    public function testMakeRecharge(): void
    {
        $mantarysBalance = new MantarysRecharge( $this->validUserTest, $this->validPasswordTest );
        $response = $mantarysBalance->makeRecharge( $this->validCarrier, $this->valideAmount, $this->validPhoneNumber );

        $this->assertIsArray( $response );
        $this->assertArrayHasKey( 'Folio_Carrier', $response );
        $this->assertArrayHasKey( 'Confirmation', $response );
        //$this->assertEquals( ResponseContants::SUCCESS_TRANSACTION, $response['Confirmation'] );
    }

    public function testTimeoutRecharge(): void
    {
        $this->expectException( TimeoutException::class );

        $mantarysBalance = new MantarysRecharge( $this->validUserTest, $this->validPasswordTest );
        $response = $mantarysBalance->makeRecharge( $this->validCarrier, $this->valideAmount, $this->timeoutPhoneNumber );

        $this->assertIsArray( $response );
        // $this->assertEquals( ResponseContants::IN_MAINTENANCE, $response['Confirmation'] );
    }
}

