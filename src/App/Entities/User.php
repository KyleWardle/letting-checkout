<?php

namespace App\Entities;

class User
{
    private string $fullName;
    private int $contractLength;

    public function __construct(string $fullName, int $contractLength)
    {
        $this->fullName = $fullName;
        $this->contractLength = $contractLength;
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
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }
}