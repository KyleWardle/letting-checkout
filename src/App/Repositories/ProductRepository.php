<?php

namespace App\Repositories;

use App\Entities\Product;

class ProductRepository
{
    public function __construct()
    {
        $this->setupDatabase();
    }

    /**
     * @var Product[]
     */
    private array $products = [];

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * Mimics the database as we are not going to use one.
     */
    private function setupDatabase(): void
    {
        $this->products[] = new Product('P001', 'Photography', 20000);
        $this->products[] = new Product('P002', 'Floorplan', 10000);
        $this->products[] = new Product('P003', 'Gas Certificate', 8350);
        $this->products[] = new Product('P004', 'EICR Certificate', 5100);
    }

}