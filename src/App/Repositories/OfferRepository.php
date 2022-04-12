<?php

namespace App\Repositories;

use App\Entities\Offer;

class OfferRepository
{
    public function __construct()
    {
        $this->setupDatabase();
    }

    /**
     * @var Offer[]
     */
    private array $offers = [];

    /**
     * @return Offer[]
     */
    public function all(): array
    {
        return $this->offers;
    }

    /**
     * Mimics the database as we are not going to use one.
     */
    private function setupDatabase(): void
    {
        $this->offers[] = new Offer(12, 10);
    }
}