<?php declare(strict_types=1);

use App\Exceptions\ProductAlreadyAddedException;
use App\Services\CheckoutService;
use App\Entities\Product;

final class CheckoutProductsTest extends BaseTestCase
{
    public function testICanAddProductToCheckout()
    {
        $user = $this->getUser();

        $checkout = $this->container->get(CheckoutService::class);
        $checkout->setUser($user);

        $checkout->addProduct(new Product('P001', 'Photography', 20000));
        $checkout->addProduct(new Product('P002', 'Floorplan', 10000));

        $this->assertCount(2, $checkout->getProducts());

        $product = $checkout->getProducts()[0];
        $this->assertEquals('P001', $product->getCode());
        $this->assertEquals('Photography', $product->getName());
        $this->assertEquals(20000, $product->getPriceInPence());

        $product = $checkout->getProducts()[1];
        $this->assertEquals('P002', $product->getCode());
        $this->assertEquals('Floorplan', $product->getName());
        $this->assertEquals(10000, $product->getPriceInPence());
    }

    public function testIGetAnExceptionIfIAddTheSameProductTwice()
    {
        $user = $this->getUser();

        $checkout = $this->container->get(CheckoutService::class);
        $checkout->setUser($user);

        $checkout->addProduct(new Product('P001', 'Photography', 20000));

        $this->expectException(ProductAlreadyAddedException::class);
        $checkout->addProduct(new Product('P001', 'Photography', 20000));
    }
}