<?php declare(strict_types=1);

use App\Exceptions\ProductAlreadyAddedException;
use App\Services\CheckoutService;
use App\Entities\Product;

final class CheckoutTotalTest extends BaseTestCase
{
    public function testTotalWithNoOffersIsCorrect()
    {
        $user = $this->getUser();

        $checkout = $this->container->get(CheckoutService::class);
        $checkout->setUser($user);

        $checkout->addProduct(new Product('P001', 'Photography', 20000));
        $checkout->addProduct(new Product('P002', 'Floorplan', 10000));
        $checkout->addProduct(new Product('P003', 'Gas Certificate', 8350));
        $checkout->addProduct(new Product('P004', 'EICR Certificate', 5100));


        $this->assertEquals("£434.50", $checkout->getTotalFormatted());
    }

    public function testTotalWithLongerThanTwelveMonthContractIsCorrect()
    {
        $user = $this->getUser(15);

        $checkout = $this->container->get(CheckoutService::class);
        $checkout->setUser($user);

        $checkout->addProduct(new Product('P001', 'Photography', 20000));
        $checkout->addProduct(new Product('P002', 'Floorplan', 10000));
        $checkout->addProduct(new Product('P003', 'Gas Certificate', 8350));
        $checkout->addProduct(new Product('P004', 'EICR Certificate', 5100));


        $this->assertEquals("£391.05", $checkout->getTotalFormatted());
    }
}