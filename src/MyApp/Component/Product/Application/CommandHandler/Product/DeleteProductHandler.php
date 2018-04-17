<?php

namespace MyApp\Component\Product\Application\CommandHandler\Product;

use MyApp\Component\Product\Application\Command\Product\DeleteProductCommand;
use MyApp\Component\Product\Domain\Product;
use MyApp\Component\Product\Domain\Repository\ProductRepository;

class DeleteProductHandler
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(DeleteProductCommand $command): Product
    {
        $product = $this->productRepository->findById($command->productId());
        $this->productRepository->delete($product);

        return $product;
    }
}