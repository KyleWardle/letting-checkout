<?php

namespace App\Entities;

class Offer
{
    private int $contractLength;
    private int $discountPercentage;

    public function __construct(int $contractLength, int $discountPercentage)
    {
        $this->contractLength = $contractLength;
        $this->discountPercentage = $discountPercentage;
    }

    /**
     * @return int
     */
    public function getContractLength(): int
    {
        return $this->contractLength;
    }

    /**
     * @param int $contractLength
     */
    public function setContractLength(int $contractLength): void
    {
        $this->contractLength = $contractLength;
    }

    /**
     * @return int
     */
    public function getDiscountPercentage(): int
    {
        return $this->discountPercentage;
    }

    /**
     * @param int $discountPercentage
     */
    public function setDiscountPercentage(int $discountPercentage): void
    {
        $this->discountPercentage = $discountPercentage;
    }
}