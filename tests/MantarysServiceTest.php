<?php declare(strict_types=1);

use DevDizs\MantarysSdk\Exceptions\BadResponseException;
use DevDizs\MantarysSdk\Handlers\MantarysService;
use PHPUnit\Framework\TestCase;

final class MantarysServiceTest extends TestCase
{
    private $sku = '17';
    private $ref = '501205133215';

    public function testGetAllProducts(): void
    {
        $this->expectException( BadResponseException::class );
        $mantarysService = new MantarysService();
        $response = $mantarysService->getServicePendingAmount( $this->sku, $this->ref );

        // Assert
        // $this->assertIsArray( $response );
        // $this->assertArrayHasKey( 'Response', $response );
        // $this->assertArrayHasKey( 'editable', $response );
        // $this->assertArrayHasKey( 'rcode', $response );
        // $this->assertArrayHasKey( 'amount', $response );
        // $this->assertArrayHasKey( 'Message', $response );
        // $this->assertEquals( '1', $response['Response'] );
    }
}