<?php

namespace App\Entities;

class Product
{
    private string $code;
    private string $name;
    private int $priceInPence;

    public function __construct(string $code, string $name, int $priceInPence)
    {
        $this->code = $code;
        $this->name = $name;
        $this->priceInPence = $priceInPence;
    }

    /**
     * @return int
     */
    public function getPriceInPence(): int
    {
        return $this->priceInPence;
    }

    /**
     * @param int $priceInPence
     */
    public function setPriceInPence(int $priceInPence): void
    {
        $this->priceInPence = $priceInPence;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }
}