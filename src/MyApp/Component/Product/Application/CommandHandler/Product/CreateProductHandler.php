<?php

namespace MyApp\Component\Product\Application\CommandHandler\Product;

use MyApp\Component\Product\Application\Command\Product\CreateProductCommand;
use MyApp\Component\Product\Domain\Product;
use MyApp\Component\Product\Domain\Repository\ProductRepository;
use MyApp\Component\Product\Domain\Repository\OwnerRepository;

class CreateProductHandler
{
    private $productRepository;
    private $ownerRepository;

    public function __construct(ProductRepository $productRepository, OwnerRepository $ownerRepository)
    {
        $this->productRepository = $productRepository;
        $this->ownerRepository = $ownerRepository;
    }

    public function handle(CreateProductCommand $command) : Product
    {

        $owner = $this->ownerRepository->findById($command->ownerId());

        $product = new Product($command->name(), $command->price(), $command->description(), $owner);
        $this->productRepository->save($product);

        return $product;
    }
}