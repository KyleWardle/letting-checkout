<?php declare(strict_types=1);

use App\Services\CheckoutService;
use App\Entities\User;

final class CheckoutOffersTest extends BaseTestCase
{
    public function testUserWithContractLengthLongerThanTwelveMonthsHasDiscount()
    {
        $user = new User('Test User', 15);

        $checkout = $this->container->get(CheckoutService::class);
        $checkout->setUser($user);

        $this->assertCount(1, $checkout->getOffers());

        $offer = $checkout->getOffers()[0];
        $this->assertEquals(10, $offer->getDiscountPercentage());
    }

    public function testUserWithContractLengthEqualToTwelveMonthsHasDiscount()
    {
        $user = new User('Test User', 12);

        $checkout = $this->container->get(CheckoutService::class);
        $checkout->setUser($user);

        $this->assertCount(1, $checkout->getOffers());

        $offer = $checkout->getOffers()[0];
        $this->assertEquals(10, $offer->getDiscountPercentage());
    }

    public function testUserWithContractLengthLessThanTwelveMonthsDoesNotGetDiscount()
    {
        $user = new User('Test User', 7);

        $checkout = $this->container->get(CheckoutService::class);
        $checkout->setUser($user);

        $this->assertCount(0, $checkout->getOffers());
    }
}