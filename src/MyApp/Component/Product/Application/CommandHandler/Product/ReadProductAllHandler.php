<?php

namespace MyApp\Component\Product\Application\CommandHandler\Product;

use MyApp\Component\Product\Domain\Product;
use MyApp\Component\Product\Domain\Repository\ProductRepository;


class ReadProductAllHandler
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle() : array
    {
        $products = $this->productRepository->findAllOrderedByName();

        return $products;
    }
}