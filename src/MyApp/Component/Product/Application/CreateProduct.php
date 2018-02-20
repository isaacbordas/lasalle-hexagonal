<?php

namespace MyApp\Component\Product\Application;

use Doctrine\ORM\EntityManager;
use MyApp\Component\Product\Entity\Product;
use MyApp\Component\Product\Entity\Repository\OwnerRepository;

class CreateProduct
{
    private $ownerRepository;
    private $entityManager;

    public function __construct(OwnerRepository $ownerRepository, EntityManager $entityManager)
    {
        $this->ownerRepository = $ownerRepository;
        $this->entityManager = $entityManager;
    }

    public function execute(string $productName, float $productPrice, string $productDescription, int $productOwnerId)
    {
        $owner = $this->ownerRepository->findById($productOwnerId);
        $product = new Product($productName, $productPrice, $productDescription, $owner);
        $this->entityManager->persist($product);
        $this->entityManager->flush();

    }
}