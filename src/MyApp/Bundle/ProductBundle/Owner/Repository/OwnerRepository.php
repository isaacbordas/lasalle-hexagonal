<?php

namespace MyApp\Bundle\ProductBundle\Owner\Repository;

use MyApp\Component\Product;
use Doctrine\ORM\EntityRepository;

class OwnerRepository extends EntityRepository implements Product\Entity\Repository\OwnerRepository
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