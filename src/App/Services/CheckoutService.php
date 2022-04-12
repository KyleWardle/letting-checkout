<?php

namespace App\Services;

use App\Entities\Offer;
use App\Entities\Product;
use App\Entities\User;
use App\Exceptions\ProductAlreadyAddedException;
use App\Repositories\OfferRepository;

class CheckoutService
{
    private User $user;

    /**
     * @var Offer[]
     */
    private array $offers = [];

    /**
     * @var Product[]
     */
    private array $products = [];

    private OfferRepository $offerRepository;

    public function __construct(OfferRepository $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }

    public function setUser(User $user): void
    {
        $this->user =$user;
        $this->calculateEligibleOffers();
    }

    /**
     * @throws ProductAlreadyAddedException
     */
    public function addProduct(Product $product): void
    {
        if (in_array($product, $this->products)) {
            throw new ProductAlreadyAddedException;
        }

        $this->products[] = $product;
    }

    /**
     * @return Offer[]
     */
    public function getOffers(): array
    {
        return $this->offers;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    public function getTotalInPence(): int
    {
        $total = 0;

        foreach ($this->products as $product) {
            $total += $product->getPriceInPence();
        }

        foreach ($this->offers as $offer) {
            $total -= $this->calculatePercentage($total, $offer->getDiscountPercentage());
        }

        return $total;
    }

    public function getTotalInPounds(): float
    {
        return $this->getTotalInPence() / 100;
    }

    public function getTotalFormatted(): string
    {
        return "£". number_format($this->getTotalInPounds(), 2);
    }

    private function calculatePercentage(int $amount, int $percentage): int
    {
        return ($amount / 100) * $percentage;
    }

    private function calculateEligibleOffers(): void
    {
        $this->offers = [];

        $possibleOffers = $this->offerRepository->all();

        foreach ($possibleOffers as $offer) {
            if ($this->user->getContractLength() < $offer->getContractLength()) {
                continue;
            }

            $this->offers[] = $offer;
        }
    }
}