<?php declare(strict_types=1);

use DevDizs\MantarysSdk\Handlers\MantarysProduct;
use PHPUnit\Framework\TestCase;

final class MantarysProductTest extends TestCase
{
    private $validUserTest     = '6144135400';
    private $validPasswordTest = 'Prueba$$';

    public function testGetAllProducts(): void
    {
        $mantarysProduct = new MantarysProduct( $this->validUserTest, $this->validPasswordTest );
        $response = $mantarysProduct->getProducts();

        $this->assertIsArray( $response );
        $this->assertArrayHasKey( 'Response', $response );
        $this->assertArrayHasKey( 'pos_prices_products', $response );
        $this->assertNotEmpty( $response['pos_prices_products'] );
        $this->assertEquals( '1', $response['Response'] );
    }
}