<?php declare(strict_types=1);

use DevDizs\MantarysSdk\Handlers\MantarysBalance;
use DevDizs\MantarysSdk\ResponseContants;
use PHPUnit\Framework\TestCase;

final class MantarysBalanceTest extends TestCase
{
    private $validUserTest     = '6144135400';
    private $validPasswordTest = 'Prueba$$';

    public function testClientBalance(): void
    {
        $mantarysBalance = new MantarysBalance( $this->validUserTest, $this->validPasswordTest );
        $response = $mantarysBalance->getClientBalance();

        $this->assertIsArray( $response );
        $this->assertEquals( ResponseContants::SUCCESS_TRANSACTION, $response['Confirmation'] );
        $this->assertArrayHasKey( 'Confirmation', $response );
        $this->assertArrayHasKey( 'Balance', $response );
    }
}