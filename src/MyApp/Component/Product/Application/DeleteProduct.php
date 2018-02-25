<?php

namespace MyApp\Component\Product\Application;

use Doctrine\ORM\EntityManager;

class DeleteProduct
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function execute(int $productId)
    {
        $product_reference = $this->entityManager->getReference('\MyApp\Component\Product\Entity\Product', $productId);

        $this->entityManager->remove($product_reference);
        $this->entityManager->flush();

    }
}