<?php

namespace MyApp\Component\Product\Application\CommandHandler\Product;

use MyApp\Component\Product\Application\Command\Product\ReadProductByIdCommand;
use MyApp\Component\Product\Domain\Product;
use MyApp\Component\Product\Domain\Repository\ProductRepository;

class ReadProductByIdHandler
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(ReadProductByIdCommand $command): Product
    {
        $product = $this->productRepository->findById($command->productId());

        return $product;
    }
}