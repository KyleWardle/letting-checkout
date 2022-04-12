<?php declare(strict_types=1);

use App\Services\CheckoutService;
use App\Entities\User;

final class CheckoutOffersTest extends BaseTestCase
{
    public function testUserWithContractLengthLongerThanTwelveMonthsHasDiscount()
    {
        $user = $this->getUser(15);

        $checkout = $this->container->get(CheckoutService::class);
        $checkout->setUser($user);

        $this->assertCount(1, $checkout->getOffers());

        $offer = $checkout->getOffers()[0];
        $this->assertEquals(10, $offer->getDiscountPercentage());
    }

    public function testUserWithContractLengthEqualToTwelveMonthsHasDiscount()
    {
        $user = $this->getUser(12);

        $checkout = $this->container->get(CheckoutService::class);
        $checkout->setUser($user);

        $this->assertCount(1, $checkout->getOffers());

        $offer = $checkout->getOffers()[0];
        $this->assertEquals(10, $offer->getDiscountPercentage());
    }

    public function testUserWithContractLengthLessThanTwelveMonthsDoesNotGetDiscount()
    {
        $user = $this->getUser(7);

        $checkout = $this->container->get(CheckoutService::class);
        $checkout->setUser($user);

        $this->assertCount(0, $checkout->getOffers());
    }
}