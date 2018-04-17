<?php

namespace MyApp\Component\Product\Application\CommandHandler\Product;

use MyApp\Component\Product\Application\Command\Product\UpdateProductCommand;
use MyApp\Component\Product\Domain\Product;
use MyApp\Component\Product\Domain\Repository\ProductRepository;
use MyApp\Component\Product\Domain\Repository\OwnerRepository;

class UpdateProductHandler
{
    private $productRepository;
    private $ownerRepository;

    public function __construct(ProductRepository $productRepository, OwnerRepository $ownerRepository)
    {
        $this->productRepository = $productRepository;
        $this->ownerRepository = $ownerRepository;
    }

    public function handle(UpdateProductCommand $command) : Product
    {
        $owner = $this->ownerRepository->findById($command->ownerId());

        $product = $this->productRepository->findById($command->productId());

        if(!empty($command->name())) $product->setName($command->name());
        if(!empty($command->price())) $product->setPrice($command->price());
        if(!empty($command->description())) $product->setDescription($command->description());
        $product->setOwner($owner);

        $this->productRepository->update($product);

        return $product;
    }
}