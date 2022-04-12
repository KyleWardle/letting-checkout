<?php

namespace App\Services;

use App\Entities\Offer;
use App\Entities\User;
use App\Repositories\OfferRepository;
use App\Repositories\ProductRepository;

class CheckoutService
{
    private User $user;

    /**
     * @var Offer[]
     */
    private array $offers = [];
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

    /**
     * @return Offer[]
     */
    public function getOffers(): array
    {
        return $this->offers;
    }
}