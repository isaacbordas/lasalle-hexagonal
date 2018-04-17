<?php

namespace MyApp\Bundle\ProductBundle\Owner\Repository;

use MyApp\Component\Product\Domain\Owner;
use MyApp\Component\Product\Domain\Repository\OwnerRepository;
use MyApp\Component\Product\Domain\Exception\RepositoryException;
use MyApp\Component\Product\Domain\Exception\UnknownActorException;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class MySqlOwnerRepository implements Product\Entity\Repository\OwnerRepository
{

    public function findById($ownerId)
    {
        return $this->findOneBy(['id' => $ownerId]);
    }

    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT o FROM \MyApp\Component\Product\Entity\Owner o ORDER BY o.name ASC'
            )
            ->getResult();
    }

}