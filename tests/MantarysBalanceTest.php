<?php declare(strict_types=1);

use DevDizs\MantarysSdk\Handlers\MantarysBalance;
use DevDizs\MantarysSdk\MantarysResponseConstants;
use PHPUnit\Framework\TestCase;

final class MantarysBalanceTest extends TestCase
{

    public function testClientBalance(): void
    {
        $mantarysBalance = new MantarysBalance();
        $response = $mantarysBalance->getClientBalance();

        $this->assertIsArray( $response );
        $this->assertEquals( MantarysResponseConstants::SUCCESS_TRANSACTION, $response['Confirmation'] );
        $this->assertArrayHasKey( 'Confirmation', $response );
        $this->assertArrayHasKey( 'Balance', $response );
    }
}