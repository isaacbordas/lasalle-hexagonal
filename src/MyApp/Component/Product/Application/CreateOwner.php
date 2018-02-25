<?php

namespace MyApp\Component\Product\Application;

use Doctrine\ORM\EntityManager;
use MyApp\Component\Product\Entity\Owner;

class CreateOwner
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function execute(string $ownerName)
    {
        $owner = new Owner($ownerName);
        $this->entityManager->persist($owner);
        $this->entityManager->flush();

    }
}