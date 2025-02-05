<?php declare(strict_types=1);

use DevDizs\MantarysSdk\Handlers\MantarysBalance;
use PHPUnit\Framework\TestCase;

final class MantarysBalanceTest extends TestCase
{
    private $validUserTest     = '6144135400';
    private $validPasswordTest = 'Prueba$$';

    public function testClientBalance(): void
    {
        $mantarysBalance = new MantarysBalance( $this->validUserTest, $this->validPasswordTest );
        $response = $mantarysBalance->getClientBalance();

        echo print_r( $response, true );
    }
}