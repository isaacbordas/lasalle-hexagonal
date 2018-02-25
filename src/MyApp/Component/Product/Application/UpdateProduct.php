<?php

namespace MyApp\Component\Product\Application;

use Doctrine\ORM\EntityManager;
use MyApp\Component\Product\Entity\Product;

class UpdateProduct
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function execute(Product $product)
    {
        $this->entityManager->flush($product);
    }
}